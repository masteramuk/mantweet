<?php
# ManTweet - a twitter plugin for MantisBT
#
# Copyright (c) Victor Boctor
# Copyright (c) Mantis Team - mantisbt-dev@lists.sourceforge.net
#
# ManTweet is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# ManTweet is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with ManTweet.  If not, see <http://www.gnu.org/licenses/>.

auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

require_once( config_get( 'plugin_path' ) . 'ManTweet' . DIRECTORY_SEPARATOR . 'mantweet_api.php' ); 

$f_tweets_purge = gpc_get_bool( 'tweets_purge' );
$f_tweets_source = gpc_get_string( 'tweets_source', '' );
$f_import_query = gpc_get_string( 'import_query', '' );
$f_post_default_text = gpc_get_string( 'post_default_text', '' );
$f_view_threshold = gpc_get_int( 'view_threshold', DEVELOPER );
$f_post_threshold = gpc_get_int( 'post_threshold', DEVELOPER );
$f_avatar_size = gpc_get_int( 'avatar_size', 48 );
$f_post_to_twitter_threshold = gpc_get_int( 'post_to_twitter_threshold', NOBODY );

if ( !is_blank( $f_tweets_source ) && plugin_config_get( 'tweets_source' ) != $f_tweets_source ) {
	plugin_config_set( 'tweets_source', $f_tweets_source );
}

if ( $f_tweets_purge ) {
	mantweet_purge();
}

if ( !is_blank( $f_import_query ) && plugin_config_get( 'import_query' ) != $f_import_query ) {
	plugin_config_set( 'import_query', $f_import_query );
}

if ( plugin_config_get( 'post_default_text' ) != $f_post_default_text ) {
	plugin_config_set( 'post_default_text', $f_post_default_text );
}

if ( plugin_config_get( 'view_threshold' ) != $f_view_threshold ) {
	plugin_config_set( 'view_threshold', $f_view_threshold );
}

if ( plugin_config_get( 'post_threshold' ) != $f_post_threshold ) {
	plugin_config_set( 'post_threshold', $f_post_threshold );
}

if ( plugin_config_get( 'avatar_size' ) != $f_avatar_size ) {
	plugin_config_set( 'avatar_size', $f_avatar_size );
}

if ( plugin_config_get( 'post_to_twitter_threshold' ) != $f_post_to_twitter_threshold ) {
	plugin_config_set( 'post_to_twitter_threshold', $f_post_to_twitter_threshold );
}

print_successful_redirect( plugin_page( 'config', true ) );