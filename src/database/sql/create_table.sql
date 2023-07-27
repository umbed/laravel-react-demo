--
-- 数据库： `subsoiling`
--


CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table users add telephone varchar(50);
alter table users change email email varchar(100) null;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', NULL, '$2y$10$TxlTLkNNR8PKy5.zWDYgAuiG1aVG3GAs8MCfw5UADbOGE13q.e9QK', NULL, '2023-06-08 02:16:22', '2023-06-08 02:16:22');



CREATE TABLE IF NOT EXISTS `company` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `join_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `company_member` (
 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
 `company_id` bigint(20) NOT NULL,
 `user_id` bigint(20) NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS `car` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mark` varchar(50) NOT NULL COMMENT '车辆编号',
  `plate` varchar(50) DEFAULT NULL COMMENT '车牌号',
  `type` varchar(50) DEFAULT NULL COMMENT '车辆类型',
  `device_id` bigint(20) DEFAULT NULL COMMENT '设备id',
  `company_id` bigint(20) DEFAULT NULL COMMENT '公司id',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `devices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `imei` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL COMMENT '农机名称',
  `model` varchar(50) DEFAULT NULL COMMENT '农机型号',
  `buy_date` timestamp NULL DEFAULT NULL COMMENT '购机日期',
  `distributor` varchar(30) DEFAULT NULL COMMENT '经销商',
  `firmware` varchar(50) DEFAULT NULL COMMENT '固件版本',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imei` (`imei`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `device_work_real_time` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `imei` varchar(20) NOT NULL COMMENT '设备号',
  `lon` decimal(10,7) NOT NULL DEFAULT 0.0000000 COMMENT '经度',
  `lat` decimal(10,7) NOT NULL DEFAULT 0.0000000 COMMENT '纬度',
  `alt` decimal(10,7) NOT NULL DEFAULT 0.0000000 COMMENT '高度',
  `speed` varchar(10) NOT NULL DEFAULT '0' COMMENT '速度',
  `rtk_status` varchar(10) DEFAULT NULL COMMENT '卫星状态',
  `sate_num` varchar(10) DEFAULT NULL COMMENT '卫星数量',
  `diff_age` varchar(10) DEFAULT NULL COMMENT '差分龄期',
  `total_area` varchar(10) DEFAULT NULL COMMENT '总面积',
  `valid_area` varchar(10) DEFAULT NULL COMMENT '有效面积',
  `perimeter` varchar(10) DEFAULT NULL COMMENT '边缘',
  `depth` varchar(10) DEFAULT NULL COMMENT '深度',
  `angle` varchar(10) DEFAULT NULL COMMENT '角度',

  `address` varchar(100) DEFAULT NULL COMMENT '标准格式化地址',
  `province` varchar(20) DEFAULT NULL COMMENT '省',
  `city` varchar(20) DEFAULT NULL COMMENT '市',
  `district` varchar(20) DEFAULT NULL COMMENT '区',
  `street` varchar(20) DEFAULT NULL COMMENT '街道',
  
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imei` (`imei`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `work_type` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '类别名称',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `work_data` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `device_id` bigint(20) DEFAULT NULL COMMENT '设备id',
  `type_id` bigint(20) NOT NULL COMMENT '工作类型',

  `land_area` varchar(10) DEFAULT NULL COMMENT '地块面积',
  `work_area` varchar(10) DEFAULT NULL COMMENT '作业面积',
  `valid_area` varchar(10) DEFAULT NULL COMMENT '有效面积',
  `repet_area` varchar(10) DEFAULT NULL COMMENT '重复面积',
  `depth_avg` int(10) DEFAULT NULL COMMENT '平均深度(厘米)',
  
  `address` varchar(100) DEFAULT NULL COMMENT '标准格式化地址',
  `province` varchar(20) DEFAULT NULL COMMENT '省',
  `city` varchar(20) DEFAULT NULL COMMENT '市',
  `district` varchar(20) DEFAULT NULL COMMENT '区',
  `street` varchar(20) DEFAULT NULL COMMENT '街道',

  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
