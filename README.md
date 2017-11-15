[![Build Status](https://travis-ci.org/catalyst/moodle-tool_iprestriction.svg?branch=master)](https://travis-ci.org/catalyst/moodle-tool_iprestriction)

# IP Restriction

This plugin restricts access to Moodle courses based on a users IP address. Users who do not have an allowed IP are shown an access denied error.

**Note:** This plugin does not block Moodle Administrators from accessing a course.

## Supported Moodle Versions
This plugin currently supports Moodle:

* 3.1
* 3.2
* 3.3
* 3.4

## Prerequisites
To work this plugin requires adding a new hook to Moodle core.

This hook has not been implemented in core yet. The tracker for it is: `https://tracker.moodle.org/browse/MDL-60470`
You will need to cherry pick the code in from the Moodle tracker into the `moodlelib.php` file of your instance, before you can install the plugin.


## Installation
To install this plugin in your Moodle.
1. Ensure the steps in the *Prerequisite* section have been completed.
2. Get the code and copy/ install it to: `<moodledir>/admin/tool/iprestriction`
3. Run the upgrade: `sudo -u www-data php admin/cli/upgrade` **Note:** the user may be different to www-data on your system.

## Configuration
To configure course level IP restriction.

1. Log into your Moodle site as an administrator.
2. Navigate to the course you wish to restrict by IP.
3. From the *Course Administration menu* click on *IP Restriction*
4. Select the *Enable IP Restriction* check box.
5. In the *IP Whitelist* text box enter the IPs to whitelist. Enter one IP per line, CIDR blocks are not allowed.
6. Click the *Save changes* button. Users with IPs not in the list are now blocked from accessing the course.
7. Repeat these steps for any other courses you wich to block.

# Crafted by Catalyst IT

This plugin was developed by Catalyst IT Australia:

https://www.catalyst-au.net/

![Catalyst IT](/pix/catalyst-logo.png?raw=true)


# Contributing and Support

Issues, and pull requests using github are welcome and encouraged! 

https://github.com/catalyst/moodle-tool_iprestriction/issues

If you would like commercial support or would like to sponsor additional improvements
to this plugin please contact us:

https://www.catalyst-au.net/contact-us