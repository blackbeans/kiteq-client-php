PHP_ARG_ENABLE(kiteq, whether to enable kiteq support,
Make sure that the comment is aligned:
[  --enable-kiteq           Enable kiteq support])

if test "$PHP_KITEQ" != "no"; then
  PHP_NEW_EXTENSION(kiteq, kiteq.c, $ext_shared)
fi
