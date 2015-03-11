#!/bin/bash

#有扩展的情况
php thiredparty/protoc-php.php kiteq.proto

#没有扩展的情况
php thiredparty/gen.php kiteq.proto