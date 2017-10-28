# 最受欢迎教师投票系统2017

## 安装说明
1. 需要apache或nginx、php5.6及以上，mysql。
2. 要求mysql的用户名为root，默认密码为空，端口为3306(可在action.php中修改mysql的配置)

## mysql 配置
1. 创建数据库名为hise，字符集为utf8，更改mysql默认系统字符集为utf8

```sql
    CREATE DATABASE  hise DEFAULT CHARACTER SET UTF8;
```
2. 更改`hise.sql`中第29行中的csv正确的路径。
3. 在数据库hise中执行`source 'hise.sql'`的路径
4. 检查报错，乱码问题

## 站点配置
1. 复制`vote_hise`到站点目录
2. 测试 index.html 输入正确的数据后是否可以正常登录

## 后台管理
1. 直接进入 admin.php 即可查看投票结果
2. 建议重命名 admin.php
