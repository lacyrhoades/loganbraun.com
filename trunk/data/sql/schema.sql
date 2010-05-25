CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_asset (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, slug VARCHAR(255), UNIQUE INDEX asset_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content (id BIGINT AUTO_INCREMENT, site_id BIGINT NOT NULL, content_type_id BIGINT NOT NULL, last_updated_by_id BIGINT, created_by_id BIGINT, date_published DATETIME, custom_path VARCHAR(255), theme VARCHAR(255), template VARCHAR(255), module VARCHAR(255), action VARCHAR(255), publicly_editable TINYINT(1) DEFAULT '0', page_title VARCHAR(255), meta_keywords TEXT, meta_description TEXT, i18n_slug VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), INDEX date_published_idx (date_published), UNIQUE INDEX sf_sympal_content_sluggable_idx (slug), INDEX last_updated_by_id_idx (last_updated_by_id), INDEX created_by_id_idx (created_by_id), INDEX site_id_idx (site_id), INDEX content_type_id_idx (content_type_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_asset (content_id BIGINT, asset_id BIGINT, PRIMARY KEY(content_id, asset_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_edit_group (content_id BIGINT, group_id BIGINT, PRIMARY KEY(content_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_group (content_id BIGINT, group_id BIGINT, PRIMARY KEY(content_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_link (content_id BIGINT, linked_content_id BIGINT, PRIMARY KEY(content_id, linked_content_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_list (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, content_type_id BIGINT NOT NULL, rows_per_page BIGINT, sort_column VARCHAR(255), sort_order VARCHAR(255), table_method VARCHAR(255), dql_query LONGTEXT, content_id BIGINT, INDEX content_type_id_idx (content_type_id), INDEX content_id_idx (content_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_slot (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, value LONGTEXT, is_column TINYINT(1) DEFAULT '0', INDEX name_idx (name), INDEX type_idx (type), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_slot_ref (content_slot_id BIGINT, content_id BIGINT, PRIMARY KEY(content_slot_id, content_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_content_type (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, description LONGTEXT, label VARCHAR(255) NOT NULL, default_path VARCHAR(255), theme VARCHAR(255), template VARCHAR(255), module VARCHAR(255), action VARCHAR(255), slug VARCHAR(255), INDEX content_type_name_idx (name), UNIQUE INDEX content_type_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_menu_item (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, root_id BIGINT, date_published DATETIME, label VARCHAR(255), custom_path VARCHAR(255), requires_auth TINYINT(1), requires_no_auth TINYINT(1), html_attributes VARCHAR(255), site_id BIGINT NOT NULL, content_id BIGINT, slug VARCHAR(255), lft INT, rgt INT, level SMALLINT, INDEX root_id_idx (root_id), INDEX content_id_idx (content_id), INDEX site_id_idx (site_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_menu_item_group (menu_item_id BIGINT, group_id BIGINT, PRIMARY KEY(menu_item_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_page (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, content_id BIGINT, INDEX content_id_idx (content_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_plugin (id BIGINT AUTO_INCREMENT, plugin_author_id BIGINT, title VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT, summary LONGTEXT, image VARCHAR(255), users VARCHAR(255), scm VARCHAR(255), homepage VARCHAR(255), ticketing VARCHAR(255), link VARCHAR(255), is_downloaded TINYINT(1) DEFAULT '0', is_installed TINYINT(1) DEFAULT '0', is_theme TINYINT(1) DEFAULT '0', INDEX plugin_author_id_idx (plugin_author_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_plugin_author (id BIGINT AUTO_INCREMENT, name VARCHAR(255), email VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_redirect (id BIGINT AUTO_INCREMENT, site_id BIGINT NOT NULL, source VARCHAR(255) NOT NULL, destination VARCHAR(255), content_id BIGINT, INDEX site_id_idx (site_id), INDEX content_id_idx (content_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_sympal_site (id BIGINT AUTO_INCREMENT, theme VARCHAR(255), title VARCHAR(255) NOT NULL, description LONGTEXT, page_title VARCHAR(255), meta_keywords TEXT, meta_description TEXT, slug VARCHAR(255), UNIQUE INDEX site_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content ADD CONSTRAINT sf_sympal_content_site_id_sf_sympal_site_id FOREIGN KEY (site_id) REFERENCES sf_sympal_site(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content ADD CONSTRAINT sf_sympal_content_last_updated_by_id_sf_guard_user_id FOREIGN KEY (last_updated_by_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE sf_sympal_content ADD CONSTRAINT sf_sympal_content_created_by_id_sf_guard_user_id FOREIGN KEY (created_by_id) REFERENCES sf_guard_user(id) ON DELETE SET NULL;
ALTER TABLE sf_sympal_content ADD CONSTRAINT sf_sympal_content_content_type_id_sf_sympal_content_type_id FOREIGN KEY (content_type_id) REFERENCES sf_sympal_content_type(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_asset ADD CONSTRAINT sf_sympal_content_asset_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_asset ADD CONSTRAINT sf_sympal_content_asset_asset_id_sf_sympal_asset_id FOREIGN KEY (asset_id) REFERENCES sf_sympal_asset(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_edit_group ADD CONSTRAINT sf_sympal_content_edit_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_edit_group ADD CONSTRAINT sf_sympal_content_edit_group_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_group ADD CONSTRAINT sf_sympal_content_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_group ADD CONSTRAINT sf_sympal_content_group_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_link ADD CONSTRAINT sf_sympal_content_link_linked_content_id_sf_sympal_content_id FOREIGN KEY (linked_content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_link ADD CONSTRAINT sf_sympal_content_link_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_list ADD CONSTRAINT sf_sympal_content_list_content_type_id_sf_sympal_content_type_id FOREIGN KEY (content_type_id) REFERENCES sf_sympal_content_type(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_list ADD CONSTRAINT sf_sympal_content_list_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_slot_ref ADD CONSTRAINT sf_sympal_content_slot_ref_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_content_slot_ref ADD CONSTRAINT scsi FOREIGN KEY (content_slot_id) REFERENCES sf_sympal_content_slot(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_menu_item ADD CONSTRAINT sf_sympal_menu_item_site_id_sf_sympal_site_id FOREIGN KEY (site_id) REFERENCES sf_sympal_site(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_menu_item ADD CONSTRAINT sf_sympal_menu_item_root_id_sf_sympal_menu_item_id FOREIGN KEY (root_id) REFERENCES sf_sympal_menu_item(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_menu_item ADD CONSTRAINT sf_sympal_menu_item_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE SET NULL;
ALTER TABLE sf_sympal_menu_item_group ADD CONSTRAINT sf_sympal_menu_item_group_menu_item_id_sf_sympal_menu_item_id FOREIGN KEY (menu_item_id) REFERENCES sf_sympal_menu_item(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_menu_item_group ADD CONSTRAINT sf_sympal_menu_item_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_page ADD CONSTRAINT sf_sympal_page_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_plugin ADD CONSTRAINT sf_sympal_plugin_plugin_author_id_sf_sympal_plugin_author_id FOREIGN KEY (plugin_author_id) REFERENCES sf_sympal_plugin_author(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_redirect ADD CONSTRAINT sf_sympal_redirect_site_id_sf_sympal_site_id FOREIGN KEY (site_id) REFERENCES sf_sympal_site(id) ON DELETE CASCADE;
ALTER TABLE sf_sympal_redirect ADD CONSTRAINT sf_sympal_redirect_content_id_sf_sympal_content_id FOREIGN KEY (content_id) REFERENCES sf_sympal_content(id) ON DELETE CASCADE;
