Advise: please make a backup of your data before you manipulate your database directly with phpMyAdmin

We use a multi-column-key to make sure that only one entry per group / user is added to the usertable. If you do a fresh install you will notice a red line during installation named "TODO check this --- Index "unique_key" not found". This happens if the key really doesnt exist OR the database doesnt execute the statement.

The Groupjive install script will then try to create the index. If you get an error message "TODO check this --- Error while alter table #__gj_users". Then you have to look into your database. The creation of the key failed.

Please check the following:

- Open phpMyAdmin and go to your Joomla database

- does the table #__gj_users exist? (if not try to install Groupjive again)

- does the key "unique_key" exist? (if not try to create the key manually)

- SQL 1 - execute this statement in phpMyAdmin ------------------------------
ALTER TABLE `jos_gj_users` 
ADD UNIQUE `unique_key` ( `id_user` , `id_group` )
-----------------------------------------------------------------------------

if manual creation fails you have to check if duplicates exists.

This can be done with this SQL statment:

- SQL 2 - execute this statement in phpMyAdmin ------------------------------
SELECT MAX(id), COUNT(*)
FROM `jos_gj_users`
GROUP BY id_user, id_group
HAVING COUNT(*) > 1;
-----------------------------------------------------------------------------

you will get a list of duplicate ids and you must delete this lines.

- SQL 3 - execute this statement in phpMyAdmin ------------------------------
DELETE FROM jos_gj_users 
WHERE id IN (
-->insert here comma separated list of ids<--
);
-----------------------------------------------------------------------------

you can execute SQL 2 again to check if there are still duplicates. If an empty result returns you have to execute SQL 1.

If SQL 1 is executed without errors you should have no problems with your Groupjive user table.
