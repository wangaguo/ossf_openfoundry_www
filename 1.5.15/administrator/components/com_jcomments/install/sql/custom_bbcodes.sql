INSERT INTO `#__jcomments_custom_bbcodes` (`name`, `simple_pattern`, `simple_replacement_html`, `simple_replacement_text`, `pattern`, `replacement_html`, `replacement_text`, `button_open_tag`, `button_close_tag`, `button_title`, `button_prompt`, `button_image`, `button_css`, `button_enabled`, `ordering`, `published`, `button_acl`)
VALUES ('YouTube Video', '[youtube]http://www.youtube.com/watch?v={IDENTIFIER}[/youtube]', '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/{IDENTIFIER}"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/{IDENTIFIER}" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>', 'http://www.youtube.com/watch?v={IDENTIFIER}', '\\[youtube\\]http\\://www\\.youtube\\.com/watch\\?v\\=([A-Za-z0-9-_]+)\\[\\/youtube\\]', '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/${1}"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/${1}" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>', 'http://www.youtube.com/watch?v=${1}', '[youtube]', '[/youtube]', 'YouTube Video', '', '', 'bbcode-youtube', 1, 1, 1, 'Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator');
INSERT INTO `#__jcomments_custom_bbcodes` (`name`, `simple_pattern`, `simple_replacement_html`, `simple_replacement_text`, `pattern`, `replacement_html`, `replacement_text`, `button_open_tag`, `button_close_tag`, `button_title`, `button_prompt`, `button_image`, `button_css`, `button_enabled`, `ordering`, `published`, `button_acl`)
VALUES ('Google Video', '[google]http://video.google.com/videoplay?docid={IDENTIFIER}[/google]', '<embed style="width:425px; height:350px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId={IDENTIFIER}" flashvars=""></embed>', 'http://video.google.com/videoplay?docid={IDENTIFIER}', '\\[google\\]http\\://video\\.google\\.com/videoplay\\?docid\\=([A-Za-z0-9-_]+)\\[\\/google\\]', '<embed style="width:425px; height:350px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=${1}" flashvars=""></embed>', 'http://video.google.com/videoplay?docid=${1}', '[google]', '[/google]', 'Google Video', '', '', 'bbcode-google', 1, 2, 1, 'Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator');
INSERT INTO `#__jcomments_custom_bbcodes` (`name`, `simple_pattern`, `simple_replacement_html`, `simple_replacement_text`, `pattern`, `replacement_html`, `replacement_text`, `button_open_tag`, `button_close_tag`, `button_title`, `button_prompt`, `button_image`, `button_css`, `button_enabled`, `ordering`, `published`, `button_acl`)
VALUES ('Wiki', '[wiki]{TEXT}[/wiki]', '<a href="http://www.wikipedia.org/wiki/{TEXT}" title="{TEXT}" target="_blank">{TEXT}</a>', '{TEXT}', '\\[wiki\\]([\\w0-9-\\+\\.,_ ]+)\\[\\/wiki\\]', '<a href="http://www.wikipedia.org/wiki/${1}" title="${1}" target="_blank">${1}</a>', '${1}', '[wiki]', '[/wiki]', 'Wikipedia', '', '', 'bbcode-wiki', 1, 3, 1, 'Unregistered,Registered,Author,Editor,Publisher,Manager,Administrator,Super Administrator');
