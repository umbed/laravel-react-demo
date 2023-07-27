alter table users add telephone varchar(50);
alter table users change email email varchar(100) null;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@test.com', NULL, '$2y$10$TxlTLkNNR8PKy5.zWDYgAuiG1aVG3GAs8MCfw5UADbOGE13q.e9QK', NULL, '2023-06-08 02:16:22', '2023-06-08 02:16:22');
