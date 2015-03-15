/*
  +----------------------------------------------------------------------+
  | PHP Version 5                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2013 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author:                                                              |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifndef PHP_KITEQ_H
#define PHP_KITEQ_H

extern zend_module_entry kiteq_module_entry;
#define phpext_kiteq_ptr &kiteq_module_entry

#define PHP_KITEQ_VERSION "0.1.0" /* Replace with version number for your extension */

#ifdef PHP_WIN32
#	define PHP_KITEQ_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_KITEQ_API __attribute__ ((visibility("default")))
#else
#	define PHP_KITEQ_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

#include <ctype.h>
#include <sys/socket.h>
#include <sys/types.h>

PHP_MINIT_FUNCTION(kiteq);
PHP_MSHUTDOWN_FUNCTION(kiteq);
PHP_RINIT_FUNCTION(kiteq);
PHP_RSHUTDOWN_FUNCTION(kiteq);
PHP_MINFO_FUNCTION(kiteq);

PHP_FUNCTION(confirm_kiteq_compiled);
PHP_FUNCTION(kiteq_connect);
PHP_FUNCTION(kiteq_request);

#define BYTE_0(x) ((x) & 0xff)
#define BYTE_1(x) ((x)>>8 & 0xff)
#define BYTE_2(x) ((x)>>16 & 0xff)
#define BYTE_3(x) ((x)>>24 & 0xff)

// #define KITEQ_DEBUG 1

typedef struct {
  // 序号
  unsigned char seq_0;
  unsigned char seq_1;
  unsigned char seq_2;
  unsigned char seq_3;
  // 类型
  unsigned char type;
  // 长度
  unsigned char length_0;
  unsigned char length_1;
  unsigned char length_2;
  unsigned char length_3;
  // 数据
  char data[0];
} packet;

typedef struct {
  // 与服务器连接以后的描述符
  int sockfd;
  // 超时时间
  struct timeval tv;
  // 服务器的host
  char *host;
  // 服务器端口
  long port;
  // 服务器的发送序号
  long seq;
} kiteq_client;
/* 
  	Declare any global variables you may need between the BEGIN
	and END macros here:     

ZEND_BEGIN_MODULE_GLOBALS(kiteq)
	long  global_value;
	char *global_string;
ZEND_END_MODULE_GLOBALS(kiteq)
*/

/* In every utility function you add that needs to use variables 
   in php_kiteq_globals, call TSRMLS_FETCH(); after declaring other 
   variables used by that function, or better yet, pass in TSRMLS_CC
   after the last function argument and declare your utility function
   with TSRMLS_DC after the last declared argument.  Always refer to
   the globals in your function as KITEQ_G(variable).  You are 
   encouraged to rename these macros something shorter, see
   examples in any other php module directory.
*/

#ifdef ZTS
#define KITEQ_G(v) TSRMG(kiteq_globals_id, zend_kiteq_globals *, v)
#else
#define KITEQ_G(v) (kiteq_globals.v)
#endif

#endif	/* PHP_KITEQ_H */


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
