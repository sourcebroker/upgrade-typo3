DROP TABLE IF EXISTS cf_extbase_typo3dbbackend_queries;
DROP TABLE IF EXISTS cf_extbase_typo3dbbackend_queries_tags;
DROP TABLE IF EXISTS fe_session_data;
DROP TABLE IF EXISTS sys_preview;
DROP TABLE IF EXISTS tx_imageopt_images;
DROP TABLE IF EXISTS tx_rtehtmlarea_acronym;

DROP INDEX `parent` ON `sys_category`;
DROP INDEX `parent` ON `sys_domain`;
DROP INDEX `fulltextdata` ON `index_fulltext`;
DROP INDEX `metaphonedata` ON `index_fulltext`;

ALTER TABLE `be_sessions` DROP `ses_name`;
ALTER TABLE `be_sessions` DROP `ses_hashlock`;
ALTER TABLE `pages` DROP `url_scheme`;
ALTER TABLE `sys_file_reference` DROP `downloadname`;
ALTER TABLE `fe_users` DROP `fe_cruser_id`;
ALTER TABLE `fe_sessions` DROP `ses_name`;
ALTER TABLE `fe_sessions` DROP `ses_hashlock`;
ALTER TABLE `tt_content` DROP `menu_type`;
ALTER TABLE `tt_content` DROP `select_key`;
