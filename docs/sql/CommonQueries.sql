--Create data file
INSERT INTO data_file (name, hash, path, size, description) VALUES(?, ?, ?, ?, ?);

UPDATE data_file (fk_cust_id, name, hash, path, size, description, date_last_accessed, public) VALUES(?, ?, ?, ?, ?, ?, ?, ?) WHERE pk_file_id=?;

UPDATE data_file SET fk_cust_id=?, name=?, hash=?, path=?, size=?, description=?, date_last_accessed=?, public=? WHERE pk_file_id=?

INSERT INTO user SET pk_cust_id='', goog_id='', fname='', sname='', email='', administrator='', account_enabled='', login_count='', fk_plan_id='', credit='', unpaid_alert='';

INSERT INTO user SET goog_id='my_google_id', fname='Test', sname='User', email='test@test.com', fk_plan_id='FREE';
