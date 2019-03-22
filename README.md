# Brokfree-HTML-Pages-Simple-design
Project on Rental agreements without broker.
Configuration of localhost for this projects :
configure smtp for mail sending - just google it and check what and all changes are to be made...

highlights : 
php.ini - change fields : smtp_port, SMTP, sendmail_from, sendmail_path
sendmail.ini - change fields : smtp_server, smtp_port, error_logfile=error.log, auth_username = your configured gmailid, 
auth_password = password for that gmailid, force_sender = your configured gmailid, debug_file = debug.log
