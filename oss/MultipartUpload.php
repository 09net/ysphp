<?php
require_once __DIR__ . '/Common.php';

use OSS\OssClient;
use OSS\Core\OssUtil;
use OSS\Core\OssException;

$bucket = Common::getBucketName();
$ossClient = Common::getOssClient();
if (is_null($ossClient)) exit(1);

//*******************************简单使用***************************************************************

/**
 * 查看完整用法中的 "putObjectByRawApis"函数，查看使用基础的分片上传api进行文件上传，用户可以基于这个自行实现断点续传等功能
 */

// 使用分片上传接口上传文件, 接口会根据文件大小决定是使用普通上传还是分片上传
$ossClient->multiuploadFile($bucket, "file.php", __FILE__, array());
Common::println("local file " . __FILE__ . " is uploaded to the bucket $bucket, file.php");


// 上传本地目录到bucket内的targetdir子目录中
$ossClient->uploadDir($bucket, "targetdir", __DIR__);
Common::println("local dir " . __DIR__ . " is uploaded to the bucket $bucket, targetdir/");


// 列出当前未完成的分片上传
$listMultipartUploadInfo = $ossClient->listMultipartUploads($bucket, array());


//******************************* 完整用法参考下面函数 ****************************************************

multiuploadFile($ossClient, $bucket);
putObjectByRawApis($ossClient, $bucket);
uploadDir($ossClient, $bucket);
listMultipartUploads($ossClient, $bucket);

/**
 * 通过multipart上传文件
 *
 * @param OssClient $ossClient OssClient实例
 * @param string $bucket 存储空间名称
 * @return null
 */
