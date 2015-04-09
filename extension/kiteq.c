/*
  +----------------------------------------------------------------------+
  | PHP Version 5														                             |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2013 The PHP Group								                 |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,	     |
  | that is bundled with this package in the file LICENSE, and is		     |
  | available through the world-wide-web at the following url:		       |
  | http://www.php.net/license/3_01.txt								                   |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to		       |
  | license@php.net so we can mail you a copy immediately.			         |
  +----------------------------------------------------------------------+
  | Author:															                                 |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_kiteq.h"
#include <arpa/inet.h>
#include <netinet/in.h>
#include <unistd.h>
#include <stdint.h>
#include <inttypes.h>
#include <sys/types.h>
#include <ctype.h>
#include <sys/socket.h>
#include <stdio.h>
#include <stdlib.h>
#include <sys/time.h>

/* If you declare any globals in php_kiteq.h uncomment this:
ZEND_DECLARE_MODULE_GLOBALS(kiteq)
*/

/* True global resources - no need for thread safety here */
static int le_kiteq;
static int le_kiteq_conns;

/* {{{ kiteq_functions[]
 *
 * Every user visible function must have an entry in kiteq_functions[].
 */
const zend_function_entry kiteq_functions[] = {
	PHP_FE(confirm_kiteq_compiled,	NULL)		/* For testing, remove later. */
	PHP_FE(kiteq_connect,	NULL)
	PHP_FE(kiteq_request,	NULL)
	PHP_FE_END	/* Must be the last line in kiteq_functions[] */
};
/* }}} */

/* {{{ kiteq_module_entry
 */
zend_module_entry kiteq_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
	STANDARD_MODULE_HEADER,
#endif
	"kiteq",
	kiteq_functions,
	PHP_MINIT(kiteq),
	PHP_MSHUTDOWN(kiteq),
	PHP_RINIT(kiteq),		/* Replace with NULL if there's nothing to do at request start */
	PHP_RSHUTDOWN(kiteq),	/* Replace with NULL if there's nothing to do at request end */
	PHP_MINFO(kiteq),
#if ZEND_MODULE_API_NO >= 20010901
	PHP_KITEQ_VERSION,
#endif
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_KITEQ
ZEND_GET_MODULE(kiteq)
#endif

/* {{{ PHP_INI
 */
/* Remove comments and fill if you need to have entries in php.ini
PHP_INI_BEGIN()
	STD_PHP_INI_ENTRY("kiteq.global_value",	  "42", PHP_INI_ALL, OnUpdateLong, global_value, zend_kiteq_globals, kiteq_globals)
	STD_PHP_INI_ENTRY("kiteq.global_string", "foobar", PHP_INI_ALL, OnUpdateString, global_string, zend_kiteq_globals, kiteq_globals)
PHP_INI_END()
*/
/* }}} */

/* {{{ php_kiteq_init_globals
 */
/* Uncomment this function if you have INI entries
static void php_kiteq_init_globals(zend_kiteq_globals *kiteq_globals)
{
	kiteq_globals->global_value = 0;
	kiteq_globals->global_string = NULL;
}
*/
/* }}} */


static void kiteq_free(kiteq_client *c) {
	php_printf("free kiteq_client\n");
  // 关闭连接
  close(c->sockfd);
  // 释放空间
	efree(c);
}

static void _kiteq_conns_dtor(zend_rsrc_list_entry *rsrc TSRMLS_DC) /* {{{ */
{
	kiteq_free((kiteq_client *)rsrc->ptr TSRMLS_CC);
}

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(kiteq)
{
	le_kiteq_conns = zend_register_list_destructors_ex(NULL, _kiteq_conns_dtor, "kiteq connection",module_number);
	/* If you have INI entries, uncomment these lines 
	REGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}

/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(kiteq)
{
	/* uncomment this line if you have INI entries
	UNREGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request start */
/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(kiteq)
{
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request end */
/* {{{ PHP_RSHUTDOWN_FUNCTION
 */
PHP_RSHUTDOWN_FUNCTION(kiteq)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(kiteq)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "kiteq support", "enabled");
	php_info_print_table_end();

	/* Remove comments if you have entries in php.ini
	DISPLAY_INI_ENTRIES();
	*/
}
/* }}} */


/* Remove the following function when you have successfully modified config.m4
   so that your module can be compiled into PHP, it exists only for testing
   purposes. */

/* Every user-visible function in PHP should document itself in the source */
/* {{{ proto string confirm_kiteq_compiled(string arg)
   Return a string to confirm that the module is compiled in */
PHP_FUNCTION(confirm_kiteq_compiled)
{
	char *arg = NULL;
	int arg_len, len;
	char *strg;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &arg, &arg_len) == FAILURE) {
		return;
	}

	len = spprintf(&strg, 0, "Congratulations! You have successfully modified ext/%.78s/config.m4. Module %.78s is now compiled into PHP.", "kiteq", arg);
	RETURN_STRINGL(strg, len, 0);
}
/* }}} */
/* The previous line is meant for vim and emacs, so it can correctly fold and 
   unfold functions in source code. See the corresponding marks just before 
   function definition, where the functions purpose is also documented. Please 
   follow this convention for the convenience of others editing your code.
*/


static int _kiteq_connect(kiteq_client *client) {
	int on = 1;
	// 创建连接
	client->sockfd = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);
	// 设置超时时间
	setsockopt(client->sockfd, SOL_SOCKET, SO_RCVTIMEO, &client->tv, sizeof(struct timeval));
	setsockopt(client->sockfd, SOL_SOCKET, SO_SNDTIMEO, &client->tv, sizeof(struct timeval));
	// 设置长连接
	setsockopt(client->sockfd, SOL_SOCKET, SO_KEEPALIVE, &on, sizeof(on));
	// 设置重用地址
	setsockopt(client->sockfd, SOL_SOCKET, SO_REUSEADDR, &on, sizeof(on));
	// 连接
	struct sockaddr_in remote_addr;
	remote_addr.sin_family = AF_INET;
	remote_addr.sin_addr.s_addr = inet_addr(client->host);
	remote_addr.sin_port = htons(client->port);
	if (connect(client->sockfd, (struct sockaddr *)&remote_addr, sizeof(struct sockaddr))<0) {
		php_error_docref(NULL TSRMLS_CC, E_WARNING, "%s", strerror(errno));
        return 1;
	}
#ifdef KITEQ_DEBUG
	php_printf("dail %d\n", client->sockfd);
#endif
  return 0;
}

PHP_FUNCTION(kiteq_request) {
	char *data;
	int len;
	long type;
	zval *client_link = NULL;
	int client_link_id = -1;
	kiteq_client *client = NULL;
    struct timeval tv;
    long begin,end;
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "rsl", &client_link, &data, &len, &type) == FAILURE) {
        RETURN_FALSE;
    }
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	begin = tv.tv_usec;
#endif
	// 获取连接
	ZEND_FETCH_RESOURCE(client, kiteq_client*, &client_link, client_link_id, "kiteq connection", le_kiteq_conns);
    if (client == NULL) {
        php_error_docref(NULL TSRMLS_CC, E_WARNING, "%s", "kiteq server not find in persistent list");
        RETURN_FALSE;
    }
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	end = tv.tv_usec;
	php_printf("fetch use %ld ns\n", end-begin);

	// 创建发送对象
	php_printf("size:%ld\n", sizeof(packet));
#endif
	// 设置发送Packet的头部
	packet *p = (packet*)emalloc(sizeof(packet) + len + 2);
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	begin = tv.tv_usec;
	php_printf("emalloc packet use %ld ns\n", begin-end);
#endif
	client->seq++;
	p->seq_0 = BYTE_3(client->seq);
	p->seq_1 = BYTE_2(client->seq);
	p->seq_2 = BYTE_1(client->seq);
	p->seq_3 = BYTE_0(client->seq);
	p->type = type;
	p->length_0 = BYTE_3(len);
	p->length_1 = BYTE_2(len);
	p->length_2 = BYTE_1(len);
	p->length_3 = BYTE_0(len);
	memcpy(p->data, data, len);
	memcpy(p->data + len, "\r\n", 2);
#ifdef KITEQ_DEBUG
	// 打印头部
	int i;
	char *s = (char *)p;
	for (i=0;i<sizeof(packet) + len + 2;i++) {
		php_printf("%d ", s[i]);
		php_printf("\n");
	}
	php_printf("send data length %d\n", len);
	php_printf("send data seq %ld\n", client->seq);
	
	gettimeofday(&tv,NULL);
	end = tv.tv_usec;
	php_printf("memcpy data use %ld ns\n", end-begin);

	// 发送
	php_printf("send to fd :%d\n", client->sockfd);
#endif
	if (send(client->sockfd, (char *)p, sizeof(packet) + len + 2, 0) < 0) {
        // 发送超时 从持久化资源列表删除
        zend_list_delete(Z_LVAL_P(client_link));
		php_error_docref(NULL TSRMLS_CC, E_WARNING, "kiteq send packet timeout : %s", strerror(errno));
		RETURN_FALSE;
	}
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	begin = tv.tv_usec;
	php_printf("send use %ld\n", begin-end);
	php_printf("recv from fd :%d\n", client->sockfd);
#endif
	memset(p, 0, sizeof(packet) + len + 2);
	int ret;
	// 获取结果
	if ((ret = recv(client->sockfd, (char *)p, sizeof(packet), 0)) <= 0) {
        // 读取超时 从持久化资源列表删除
        zend_list_delete(Z_LVAL_P(client_link));
		php_error_docref(NULL TSRMLS_CC, E_WARNING, "kiteq read packet header timeout : %s", strerror(errno));
		RETURN_FALSE;
	}
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	end = tv.tv_usec;
	php_printf("recv packet header use %ld ns\n", end - begin);

	php_printf("read len:%d\n", ret);
	s = (char *)p;
	for (i=0;i<sizeof(packet) + len + 2;i++) {
		php_printf("%d ", s[i]);
		php_printf("\n");
	}
#endif
	// 获取读数据的长度
	len = 0;
	len |= p->length_0 << 24;
	len |= p->length_1 << 16;
	len |= p->length_2 << 8;
	len |= p->length_3;
#ifdef KITEQ_DEBUG
	php_printf("data recv length :%d\n", len);
#endif
	p = (packet *)erealloc(p, sizeof(packet) + sizeof(char) * len + 2);
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	begin = tv.tv_usec;
	php_printf("realloc data use %ld ns\n", begin - end);
#endif
	if (recv(client->sockfd, (char*)p+sizeof(packet), len + 2, 0) <= 0) {
        // 读取超时 从持久化资源列表删除
        zend_list_delete(Z_LVAL_P(client_link));
		php_error_docref(NULL TSRMLS_CC, E_WARNING, "kiteq read packet body timeout : %s", strerror(errno));
		RETURN_FALSE;
	}
#ifdef KITEQ_DEBUG
	gettimeofday(&tv,NULL);
	end = tv.tv_usec;
	php_printf("recv packet use %ld ns\n", end - begin);
#endif
	array_init(return_value);

	add_next_index_stringl(return_value, p->data, len, 1);
	add_next_index_long(return_value, p->type);

	efree(p);
}

PHP_FUNCTION(kiteq_connect) {
	char *host;
	int host_len;
	long port;
	long timeout;
	char *hashkey;
	zend_rsrc_list_entry *le;
	kiteq_client *client;
    zval *client_link;
    int new = 0;
	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "sll", &host, &host_len, &port, &timeout) == FAILURE) {
		RETURN_FALSE;
	}
	spprintf(&hashkey, 0, "kiteq_conn_%s:%ld", host, port);
	if (zend_hash_find(&EG(persistent_list), hashkey, strlen(hashkey)+1, (void **)&le) == FAILURE) {
#ifdef KITEQ_DEBUG
		php_printf("new connection %s\n", hashkey);
#endif
        zend_rsrc_list_entry new_le;
        client = (kiteq_client*)emalloc(sizeof(kiteq_client));
        client->host = host;
        client->port = port;
        client->seq = 0;
        client->tv.tv_sec = timeout/1000;
        client->tv.tv_usec = (timeout % 1000) * 1000;
        if (_kiteq_connect(client) != 0) {
            efree(client);
            RETURN_FALSE;
        }
        // 注册到持久化列表里
        Z_TYPE(new_le) = le_kiteq_conns;
        new_le.ptr = client;
        zend_hash_update(&EG(persistent_list),
            hashkey, strlen(hashkey)+1, (void *) &new_le, sizeof(zend_rsrc_list_entry), NULL);
        new = 1;
	} else {
		client = (kiteq_client *) le->ptr;
	}

    MAKE_STD_ZVAL(client_link);
    ZEND_REGISTER_RESOURCE(client_link, client, le_kiteq_conns);

    array_init(return_value);

    add_next_index_long(return_value, new);
    zend_hash_next_index_insert(Z_ARRVAL_P(return_value), &client_link, sizeof(zval *), NULL);
	
}


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
