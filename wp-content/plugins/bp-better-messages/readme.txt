=== BP Better Messages ===
Contributors: wordplus
Donate link: https://www.wordplus.org/donate/
Tags: BuddyPress, messages, bp messages, private message, private messages, pm, chat, live, realtime, chat system, communication, messaging, social, users, ajax, websocket
Requires at least: 4.0
Tested up to: 5.6
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

**BP Better Messages** – is a fully featured **replacement for standard BuddyPress Messages** and also can work as **private messaging system for WordPress** when using without BuddyPress.
Plugin is fully backward compatible with BuddyPress Messages.

**[More Info & Demo](https://www.wordplus.org/downloads/bp-better-messages/)**

https://www.youtube.com/watch?v=WdsZb8SB0S8

**Improved features comparing to standard system:**

* AJAX or WebSocket powered realtime conversations
* Reworked email notifications ([More info](https://wordpress.org/plugins/bp-better-messages/faq/))
* Fully new concept and design
* Files Uploading
* Embedded links with thumbnail, title, etc...
* Emoji selector (using cloudflared CDN to serve EmojiOne)
* Message Deleting
* oEmbed YouTube, Vimeo, VideoPress, Flickr, DailyMotion, Kickstarter, Meetup.com, Mixcloud, SoundCloud and more
* Message sound notification
* Whole site messages notifications (User will be notified anywhere with small notification window)
* Mass messaging feature

**And many more features not listed here and constantly expanding**

**Supported features from standard messages system:**

* Private Conversations
* Multiple Users Conversations
* Subjects
* Searching
* Mark messages as favorite

**Tested themes:**

* [Beehive](https://www.wordplus.org/beehive) (advanced compatibility)
* [BuddyBoss](https://www.wordplus.org/buddyboss) (compatibility tested)

**Tested plugins:**

* [Block, Suspend, Report for BuddyPress](https://www.wordplus.org/BSRB)
(use this plugin to allow users to block each other)
* [Youzer](https://www.wordplus.org/youzer)
* WPML
* LocoTranslate

**Feel free to report any incompatibility or request more plugin/theme integrations!**

**WebSocket version:**

WebSocket version is a paid option, you can get license key on our website.

We are using our server to implement websockets communications between your site and users.

Our websockets servers are completely private and do not store or track any private data.

* **Significantly** reduces the load on your server
* **Instant** conversations and notifications
* **NEW** Video calls feature
* Messages Delivery Status (sent, delivered, seen)
* Typing indicator (indicates if another participant writing message at the moment)
* Online indicator
* Works with shared hosting
* More features coming!

[Why WebSockets are a game-changer?](https://pusher.com/websockets)

**[Get WebSocket version license key](https://www.wordplus.org/downloads/bp-better-messages/) | [Terms of Use](https://www.wordplus.org/end-user-license-agreement/)**

Languages:

* English
* Russian
* Japanese

You can translate plugin to your language with LocoTranslate or [participate in plugin translation](https://translate.wordpress.org/projects/wp-plugins/bp-better-messages/).

== Frequently Asked Questions ==

= How email notifications works? =

Instead of standard notification on each new message, plugin will group messages by thread and send it every 15 minutess with cron job.

* User will not receive notifications, if they are disabled in user settings.
* User will not receive already read messages.
* User will not receive notifications, if he was online last 10 minutes or he has tab with opened site

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/bp-better-messages` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings -> BP Better Messages to configure the plugin

== Screenshots ==

1. Thread screen
1. Embedded links
1. Thread list screen
1. New Thread screen
1. Writing notification
1. Onsite notification
1. Files attachments

== Changelog ==

= 1.9.7.67 =
* Some performance improvements
* Reported bugfixes and improvements

= 1.9.7.66 =
* Reported bugfixes and improvements

= 1.9.7.65 =
* Emoji selector improvement

= 1.9.7.64 =
* Combined View feature
* Other bugfixes and improvements

= 1.9.7.63 =
* Other bugfixes and improvements

= 1.9.7.62 =
* Audio calls
* Other bugfixes and improvements

= 1.9.7.61 =
* Other bugfixes and improvements

= 1.9.7.60 =
* Other bugfixes and improvements

= 1.9.7.59 =
* PM Pro incompatibility fix
* SVG Avatars Generator incompatibility fix

= 1.9.7.58 =
* Group Threads Optimizations
* One more fix for BuddyBoss when using Easy Start option
* Other bugfixes and improvements

= 1.9.7.57 =
* Fix for BuddyBoss when using Easy Start option

= 1.9.7.56 =
* Improved video calls connectivity
* Other bugfixes and improvements

= 1.9.7.55 =
* Last activity improvement

= 1.9.7.54 =
* Video calls improvements
* Other bugfixes and improvements
* POT update

= 1.9.7.53 =
* Notification improvement

= 1.9.7.52 =
* Private message button in loop improvement

= 1.9.7.51 =
* Unread count fix

= 1.9.7.50 =
* Unread count fix
* Updated POT

= 1.9.7.49 =
* Improvements

= 1.9.7.48 =
* Fix for add friends button
* CSS Tunes

= 1.9.7.47 =
* Disallow oEmbed discover

= 1.9.7.46 =
* CSS Tune

= 1.9.7.45 =
* Improvements for RTL websites

= 1.9.7.44 =
* Added block scroll setting

= 1.9.7.43 =
* JS Fixes

= 1.9.7.42 =
* Improvements for video calls feature
* JS Improvements

= 1.9.7.41 =
* Improvements to add new thread screen

= 1.9.7.40 =
* Improvements for video calls feature
* Improved JavaScript click events not worked properly in some themes
* Fix for last_activity user meta
* Other minor improvements

= 1.9.7.39 =
* Other minor improvements

= 1.9.7.38 =
* Other minor improvements

= 1.9.7.37 =
* Added Beehive theme integration with theme colors support
* Other minor improvements

= 1.9.7.36 =
* Added video calls feature
* Other minor improvements

= 1.9.7.35 =
* Added ability to use links in restrict messages
* bug fixed and improvements

= 1.9.7.34 =
* Added shortcode [bp-better-messages]
* bug fixed and improvements

= 1.9.7.33 =
* Added roles restrictions settings
* bug fixed and improvements

= 1.9.7.32 =
* Added integration with "Block, Suspend, Report for BuddyPress" plugin
* Added integration with "LocoTranslate" plugin
* Added option to disable send on Enter button
* bug fixed and improvements

= 1.9.7.31 =
* Added oEmbed for popular services like YouTube, Vimeo, SoundCloud, etc.
* bug fixed and improvements

= 1.9.7.30 =
* delete messages feature
* initial user settings feature
* bug fixes and improvements

= 1.9.7.29 =
* bug fixes and improvements

= 1.9.7.28 =
* bug fix

= 1.9.7.27 =
* bug fixes and improvements

= 1.9.7.26 =
* Basic Email notifications for non BuddyPress websites
* bug fixes and improvements

= 1.9.7.25 =
* New thread bugfix
* CSS Improvements

= 1.9.7.24 =
* One more option for mobile settings

= 1.9.7.23 =
* iOS mobile improvement

= 1.9.7.22 =
* bug fixes and improvements

= 1.9.7.21 =
* bug fixes and improvements

= 1.9.7.20 =
* more mobile improvements
* bug fixes and improvements

= 1.9.7.19 =
* BUG fixes and improvements

= 1.9.7.18 =
* Mobile improvements
* BuddyBoss compatibility improvement
* BUG fixes and improvements

= 1.9.7.17 =
* BUG fix

= 1.9.7.16 =
* BuddyBoss activation error fix

= 1.9.7.15 =
* Added ability to read other users messages by admin
* Fixed settings bug

= 1.9.7.14 =
* Added file uploader to new thread screen
* many other bugfixes and improvements

= 1.9.7.12 =
* Maintenance release
* bugfixes and improvements

= 1.9.7.11 =
* File sharing in mini chats
* Youzer compatibility improvements
* Couple small bugfixes and improvements

= 1.9.7.10 =
* Performance improvement
* Improvement for WPML
* Fixed couple of bugs

= 1.9.7.9 =
* Security Update

= 1.9.7.8 =
* Fix for PHP 7.2

= 1.9.7.7 =
* Fix some bugs

= 1.9.7.6 =
* This is minor release, not related to main development, which fixes some problems related to Youzer plugin compatibility
* Added JetPack Lazy Load support

= 1.9.7.5 =
* Added lightbox to the images
* Improved drag & drop files to window
* Other bugfixes and improvements

= 1.9.7.4 =
* Fixed button in new BuddyPress template
* Fixed tab appearing in some themes
* Added drag & drop files to window
* Added `bp_better_messages_mini_chat_username` filter
* Other bugfixes and improvements which I dont remember :o

= 1.9.7.3 =
* Some fixes for mobile version
* Added missing localization string

= 1.9.7.2 =
* Bugfixes & Improvements

= 1.9.7 =
* Improvements for the group thread
* Improvements for fast threads
* Many bugfixes and improvements

= 1.9.6 =
**Many changes, we tested it alot and it shouldnt create problems for you, but if you found any bug, please write us**
* Added Fixed Friends Tab
* Added Fast Mode (starting thread in 1 click)
* Added Friends Only Mode
* Many bugfixes and improvements

= 1.9.5 =
* Added Fixed Threads to WebSocket version
* Other bugfixes and improvements

= 1.9.4 =
* Added Mass Messaging Feature
* Changed the way to handle licenses
* Other minor bugfixes and improvements

= 1.9.3 =
* New Mobile Layout
* New File Uploader
* Other minor bugfixes and improvements

= 1.9.2.6 =
* Some CSS improvement
* Improvements for writing notifications
* Some bug fixes for websocket version

= 1.9.2.5 =
* Fix increased load when MiniChats disabled on WebSocket

= 1.9.2.4 =
* Fixed PHP Notice
* URL parsing improvements

= 1.9.2.3 =
* Fixed icons conflict

= 1.9.2 =
* **Add Messages Delivery Status (WebSocket version)**
* Other minor bugfixes and improvements

= 1.9.1 =
* **Added ability to use plugin without BuddyPress**
* Added setting to enable Search among all users
* Added setting to disable Subject
* Added setting to disable send on enter for touch screens
* Mobile Improvements
* Other minor bugfixes and improvements

= 1.9.0.1 =
* Fixed Firefox on Mac OS
* Other minor bugfixes and improvements

= 1.9.0 =
* Added mini chats for the WebSocket version
* Other minor bugfixes and improvements

= 1.8.3 =
* Mark notifications as unread on thread read
* Other minor bugfixes

= 1.8.2 =
* Minor bugfix

= 1.8.1 =
* Transforming -- to —
* bp_better_messages_current_template filter
* Minor bugfixes

= 1.8 =
* Search feature
* Minor attachment validation improvement
* Couple of minor improvements

= 1.7.9.1 =
* WebSocket version back

= 1.7.9 =
* Randomize attachments filenames
* Fixed security error on uploading allowed extension
* Improved emojies
* Couple of minor improvements

= 1.7.8 =
* AJAX loading for old messages
* Couple of minor improvements

= 1.7.7 =
**Improved attachments:**
* Attachments can be disabled or enabled
* Attachments removed from media screen
* Added settings for max file size and allowed formats
* Changed upload dir
* Autodelete old attachments

**Other**
* Better mobile adatation
* Localization loaded earlier
* WebSocket version not available anymore and will be available later.

= 1.7.6.1 =
* Many immprovements for WebSocket version

= 1.7.6 =
* WebSocket speed improvement
* Bugfixes
* Settings initial


= 1.7.5.2 =
* Message counters improvements

= 1.7.5.1 =
* Better avatar compability with other plugins

= 1.7.5 =
* Avatars improvement
* Fallback to AJAX if connect to WebSocket server failed

= 1.7.4 =
* Popups will be stacked now if same thread
* CSS Improvements

= 1.7.3 =
* Added pre sent message hooks

= 1.7.2 =
* Security improvement

= 1.7 =
* Possible to create new lines with Shift + Enter
* Paste files fixed multiple files sending
* Private browser bug
* Line breaks not removing in new thread anymore

= 1.6.5 =
* BP Notification will not added on each message anymore
* Improved files design

= 1.6.4 =
* Multiple bugfixes and improvements
* Improved emojies

= 1.6.3 =
* Fixed files uploading for default users.
* Another bugfixes

= 1.6.2 =
* Fixed fatal error, when BP Messages component wasnt active

= 1.6.1 =
* Nice attached files and images styling
* Attached video embed
* Attached audio embed
* Multiple bugfixes and improvements

= 1.6 =
* File Uploading initial
* Multiple bugfixes and improvements

= 1.5.1 =
* Online indication (websocket version)
* Multiple bugfixes and improvements

= 1.5 =
* Replaced Standard Email notifications with grouped messages
* Multiple bugfixes and improvements

= 1.4.4 =
* WebSocket Method polished and should work perfect now
* Multiple bugfixes and improvements
* CSS improvements

= 1.4.3 =
* AJAX Method polished and should work perfect now
* CSS polished

= 1.4.2 =
* Embedded links 404 fix
* No more double notifications if 2 threads opened in different tabs
* Added AJAX Loader

= 1.4.1 =
* Embedded links improvements

= 1.4 =
* Multiple bugfixes and improvements
* Embedded links feature!

= 1.3.2 =
* Prefix fix

= 1.3.1 =
* Remove BBPress functions

= 1.3 =
* Multiple bugfixes 
* Messages menu in topbar replaced

= 1.2 =
* Added starred messages screen
* Added thread delete/restore buttons
* Added empty screens

= 1.1 =
* Code refactoring and minor improvements

= 1.0 =
* Initial release