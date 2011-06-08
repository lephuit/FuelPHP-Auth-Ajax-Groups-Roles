<?php

namespace Fuel\Migrations;

class Create_users {

	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'username' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'profile_fields' => array('type' => 'text'),
			'group' => array('constraint' => 11, 'type' => 'int'),
			'last_login' => array('constraint' => 20, 'type' => 'int'),
			'login_hash' => array('constraint' => 255, 'type' => 'varchar'),
		), array('id'));

        // add an admin account
        $admin_username = "jsidhu";
        $admin_password = "1234";
        $admin_pass_hash= \Auth::instance()->hash_password($admin_password);
        $admin_email    = "sidhu.j@gmail.com";

        $users = \Model_User::factory(array(
            'username' => $admin_username,
            'password' => $admin_pass_hash,
            'email' => $admin_email,
            'profile_fields' => '',
            'group' => '',
            'last_login' => '',
            'login_hash' => '',
        ));

        if ($users and $users->save()) {
            \Cli::write("added admin account");
        } else {
            \Cli::write("failed to add admin account");
        }
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}