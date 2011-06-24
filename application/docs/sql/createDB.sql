-- Drop all tables
DROP TABLE IF EXISTS user, payment_plan, data_file, data_field, data_cell, cluster_visualisation, cluster, cells_in_clusters;

-- User table definition
CREATE TABLE IF NOT EXISTS user (
    pk_cust_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    goog_id VARCHAR(128) NOT NULL,
    fname VARCHAR(32),
    sname VARCHAR(32),
    email VARCHAR(128) NOT NULL,
    administrator BOOLEAN DEFAULT 0,
    account_enabled BOOLEAN DEFAULT 1,
    login_count INT DEFAULT 0,
    fk_plan_id INT,
    credit INT DEFAULT 0,
    unpaid_alert BOOLEAN DEFAULT 0
    )ENGINE=INNODB;
    
-- Payment plan table
CREATE TABLE IF NOT EXISTS payment_plan (
    pk_plan_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    description VARCHAR(512) NOT NULL,
    admin_notes VARCHAR(512) NOT NULL,
    plan_group_id INT DEFAULT 0,
    monthly_cost DECIMAL(10,2) DEFAULT 0.00,
    storage_soft_limit INT DEFAULT 0,
    storage_hard_limit INT DEFAULT 0,
    visualisation_limit INT DEFAULT 0,
    date_added TIMESTAMP DEFAULT NOW(),
    date_start TIMESTAMP DEFAULT '0000-00-00 00:00:00',
    date_end TIMESTAMP DEFAULT '0000-00-00 00:00:00'
    )ENGINE=INNODB;

-- Populate payment plan with default record if table is empty
INSERT INTO payment_plan (name, description, admin_notes, plan_group_id,
    monthly_cost, storage_soft_limit, storage_hard_limit, visualisation_limit,
    date_start, date_end) 
    SELECT 'Free', 'Free Plan', 'Free Plan', 1, 0.00, 0, 0, 1, 
    '1000-01-01 00:00:00', '9999-12-31 23:59:59'
    FROM DUAL
    WHERE NOT EXISTS (SELECT * FROM payment_plan);

-- Dataset meta data
CREATE TABLE IF NOT EXISTS dataset (
    pk_dataset_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_cust_id INT NOT NULL,
    name VARCHAR(128) NOT NULL,
    goog_spreadsheet_uri VARCHAR(128) NOT NULL,
    goog_worksheet_uri VARCHAR(128) NOT NULL,
    goog_last_updated TIMESTAMP DEFAULT '0000-00-00 00:00:00',
    goog_owner_name VARCHAR(64),
    goog_owner_email VARCHAR(64),
    description VARCHAR(512),
    date_uploaded TIMESTAMP DEFAULT NOW(),
    date_last_accessed TIMESTAMP DEFAULT '0000-00-00 00:00:00',
    public BOOLEAN DEFAULT 0
    )ENGINE=INNODB;
    
-- Data field definition
CREATE TABLE IF NOT EXISTS data_field (
    pk_field_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_dataset_id INT NOT NULL,
    name VARCHAR(64) DEFAULT 'Unnamed',
    description VARCHAR(512) DEFAULT 'Description of field',
    data_type VARCHAR(32) DEFAULT 'IGNORE'
    )ENGINE=INNODB;

-- Data cell values
CREATE TABLE IF NOT EXISTS data_cell (
    pk_cell_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_dataset_id INT NOT NULL,
    fk_field_id INT NOT NULL,
    value VARCHAR(512),
    ignore BOOLEAN DEFULT 0
    )ENGINE=INNODB;

-- Cluster visualisation meta data
CREATE TABLE IF NOT EXISTS cluster_viz (
    pk_viz_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_cust_id INT NOT NULL,
    name VARCHAR(64) NOT NULL,
    hash VARCHAR(64) NOT NULL,
    description VARCHAR(512) NOT NULL,
    date_uploaded TIMESTAMP DEFAULT NOW(),
    public BOOLEAN DEFAULT 0
    )ENGINE=INNODB;

-- Cluster records
CREATE TABLE IF NOT EXISTS cluster (
    pk_cluster_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_viz_id INT NOT NULL,
    step INT NOT NULL,
    num_members INT NOT NULL
    )ENGINE=INNODB;

-- Cells in clusters
CREATE TABLE IF NOT EXISTS cells_in_clusters (
    pk_cic_id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_cluster_id INT NOT NULL,
    fk_cell_id INT NOT NULL
    )ENGINE=INNODB;


