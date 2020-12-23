#!/bin/bash

##
 # o_setup_test_data.sh:
 #
 # St: 2020-12-23 Wed 10:37 PM
 # Up: 2020-12-23 Wed 10:37 PM
 #
 # Author: SPS
 ##

php artisan db:seed --class=UserSeeder
php artisan db:seed --class=MedicalTestTypeSeeder
php artisan db:seed --class=AgentSeeder
