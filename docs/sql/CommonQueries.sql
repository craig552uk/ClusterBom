--Create data file
INSERT INTO data_file (name, hash, path, size, description) VALUES(?, ?, ?, ?, ?);

UPDATE data_file (fk_cust_id, name, hash, path, size, description, date_last_accessed, public) VALUES(?, ?, ?, ?, ?, ?, ?, ?) WHERE pk_file_id=?;

UPDATE data_file SET fk_cust_id=?, name=?, hash=?, path=?, size=?, description=?, date_last_accessed=?, public=? WHERE pk_file_id=?
