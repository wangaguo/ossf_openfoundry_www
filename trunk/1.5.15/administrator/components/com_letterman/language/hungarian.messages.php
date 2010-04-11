<?php

define( "LM_SUBSCRIBE_SUBJECT", "A [mosConfig_live_site] h�rlevel�nek MEGRENDEL�SE" );
define( "LM_SUBSCRIBE_MESSAGE", 
"Hell�, [NAME]!

A [mosConfig_live_site] h�rlev�l megrendel�sedet megkaptuk.
K�sz�nj�k!

Megrendel�sed j�v�hagy�s�hoz k�rj�k, kattints az al�bbi hivatkoz�sra vagy m�sold 
a v�g�lapra �s illeszd be a b�ng�sz� c�msor�ba:

[LINK]

_________________________
   [mosConfig_live_site]" );

define( "LM_UNSUBSCRIBE_SUBJECT", "A [mosConfig_live_site] h�rlevel�nek LEMOND�SA" );
define( "LM_UNSUBSCRIBE_MESSAGE", 
"Hell�, [NAME]!

A [mosConfig_live_site] h�rlevel�nek lemond�s�t megkaptuk, adataidat t�r�lt�k az adatb�zisb�l.

Ha egy k�s�bbi id�pontban ism�t meg szeretn�d rendelni a t�j�koztat�nkat, �r�mmel l�tunk viszont.
________________________
   [mosConfig_live_site]" );

define( "LM_NEWSLETTER_FOOTER", 
"<br/><br/>___________________________________________________________<br/>
Jelen t�j�koztat�t az�rt kapod, mert valamikor megrendelted<br/>
a [mosConfig_live_site] h�rlevel�t.<br/>
A lemond�shoz kattints ide: [UNLINK]" );

/* Module */
define( "LM_FORM_NOEMAIL", "K�rj�k, hogy m�k�d� e-mail c�met adj meg." );
define( "LM_FORM_SHORTERNAME", "K�rj�k, hogy r�videbb el�fizet�i nevet adj meg. K�sz�nj�k." );
define( "LM_FORM_NONAME", "K�rj�k, hogy �rd be az el�fizet�i nevet. K�sz�nj�k." );
define( "LM_SUBSCRIBE", "Megrendel�s" );
define( "LM_UNSUBSCRIBE", "Lemond�s" );
define( "LM_BUTTON_SUBMIT", "Feladom" );

/* Backend */
define( "LM_ERROR_NEWSLETTER_COULDNTBESENT", "Nem k�ldhet� el a h�rlev�l!" );
define( "LM_NEWSLETTER_SENDTO_X_USERS", "A h�rlev�l {X} felhaszn�l�nak elk�ldve" );
define( "LM_IMPORT_USERS", "Megrendel�k import�l�sa" );
define( "LM_EXPORT_USERS", "Megrendel�k export�l�sa" );
define( "LM_UPLAOD_FAILED", "A felt�lt�s nem siker�lt" );
define( "LM_ERROR_PARSING_XML", "iba mer�lt fel az XML f�jl elemz�sekor" );
define( "LM_ERROR_NO_XML", "K�rj�k, hogy csak XML f�jlokat t�lts fel" );
define( "LM_ERROR_EMAIL_ALREADY_ONLIST", "M�r nyilv�ntart�sba vett�k az e-mail c�met" );
define( "LM_SUCCESS_ON_IMPORT", "A(z) {X} megrendel� import�l�sa siker�lt." );
define( "LM_IMPORT_FINISHED", "Az import�l�s befejez�d�tt" );
define( "LM_ERROR_DELETING_FILE", "A f�jlt�rl�s nem siker�lt" );
define( "LM_DIR_NOT_WRITABLE", "Nem �rhat� a k�vetkez� k�nyvt�r: ".$GLOBALS['mosConfig_cachepath'] );
define( "LM_ERROR_INVALID_EMAIL", "�rv�nytelen e-mail c�m" );
define( "LM_ERROR_EMPTY_EMAIL", "�res e-mail c�m" );
define( "LM_ERROR_EMPTY_FILE", "Hiba: �res a f�jl" );
define( "LM_ERROR_ONLY_TEXT", "Csak sz�veg" );

define( "LM_SELECT_FILE", "K�rj�k, v�lassz ki egy f�jlt" );
define( "LM_YOUR_XML_FILE", "YaNC/Letterman XML export f�jlod" );
define( "LM_YOUR_CSV_FILE", "CSV import f�jl" );
define( "LM_POSITION_NAME", "A -N�v- oszlop helye" );
define( "LM_NAME_COL", "N�v oszlop" );
define( "LM_POSITION_EMAIL", "Az -Email- oszlop helye" );
define( "LM_EMAIL_COL", "Email oszlop" );
define( "LM_STARTFROM", "Az import�l�s megkezd�se sort�l..." );
define( "LM_STARTFROMLINE", "Kezd�s sort�l" );
define( "LM_CSV_DELIMITER", "CSV elv�laszt�" );
define( "LM_CSV_DELIMITER_TIP", "CSV elv�laszt�: , ; vagy tabul�tor" );

/* Newsletter Management */
define( "LM_NM", "H�rlev�lkezel�" );
define( "LM_MESSAGE", "�zenet" );
define( "LM_LAST_SENT", "Utols� k�ld�s" );
define( "LM_SEND_NOW", "K�ld�s most" );
define( "LM_CHECKED_OUT", "Checked Out" );
define( "LM_NO_EXPIRY", "Befejez�s: Nincs lej�rat" );
define( "LM_WARNING_SEND_NEWSLETTER", "Val�ban post�zni akarod a h�rlevelet?\\nFigyelem! ha nagy felhaszn�l�i csoportnak k�ld�d a levelet, akkor j�ideig eltarthat!" );
define( "LM_SEND_NEWSLETTER", "H�rlev�l k�ld�se" );
define( "LM_SEND_TO_GROUP", "K�ld�s csoportnak" );
define( "LM_MAIL_FROM", "Felad�" );
define( "LM_DISABLE_TIMEOUT", "Id�t�ll�p�s letilt�sa" );
define( "LM_DISABLE_TIMEOUT_TIP", "Jel�ld be, ha meg akarod akad�lyozni, hogy a szkript id�t�ll�p�si hib�t gener�ljon. <br/><strong>Biztons�gos m�dban nem m�k�dik!<strong>" );
define( "LM_REPLY_TO", "V�laszc�m" );
define( "LM_MSG_HTML", "�zenet (HTML-WYSIWYG)" );
define( "LM_MSG", "�zenet (HTML-forr�s)" );
define( "LM_TEXT_MSG", "v�laszthat� sz�veges �zenet" );
define( "LM_NEWSLETTER_ITEM", "H�rlev�l elem" );

/* Subscriber Management */
define( "LM_SUBSCRIBER", "Megrendel�" );
define( "LM_NEW_SUBSCRIBER", "�j megrendel�" );
define( "LM_EDIT_SUBSCRIBER", "Adatm�dos�t�s" );
define( "LM_SELECT_SUBSCRIBER", "V�lassz megrendel�t" );
define( "LM_SUBSCRIBER_NAME", "Megrendel� neve" );
define( "LM_SUBSCRIBER_EMAIL", "Megrendel� e-mail c�me" );
define( "LM_SIGNUP_DATE", "Megrendel�s d�tuma" );
define( "LM_CONFIRMED", "J�v�hagyva" );
define( "LM_SUBSCRIBER_SAVED", "A megrendel� adatainak ment�se megt�rt�nt" );
define( "LM_SUBSCRIBERS_DELETED", "Siker�lt t�r�ln�d a(z) {X} megrendel�t" );
define( "LM_SUBSCRIBER_DELETED", "A megrendel� t�rl�se siker�lt." );

/* Frontend */
define( "LM_ALREADY_SUBSCRIBED", "Te m�r megrendelted a h�rlevel�nket." );
define( "LM_NOT_SUBSCRIBED", "Jelenleg NEM vagy a h�rlevel�nk megrendel�je." );
define( "LM_YOUR_DETAILS", "Adataid:" );
define( "LM_SUBSCRIBE_TO", "H�rlevel�nk megrendel�se" );
define( "LM_UNSUBSCRIBE_FROM", "H�rlevel�nk lemond�sa" );
define( "LM_VALID_EMAIL_PLEASE", "�rd be a m�k�d� e-mail c�medet!" );
define( "LM_SAME_EMAIL_TWICE", "M�r szerepel a nyilv�ntart�sunkban az �ltalad megadott e-mail c�m!" );
define( "LM_ERROR_SENDING_SUBSCRIBE", "Nem lehetett elk�ldeni a megrendel�si �zenetet:" );
define( "LM_SUCCESS_SUBSCRIBE", "E-mail c�medet nyilv�ntart�sba vett�k." );
define( "LM_RETURN_TO_NL", "Vissza a h�rlevelekhez" );
define( "LM_ERROR_UNSUBSCRIBE_OTHER_USER", "Sajnos m�s felhaszn�l�(ka)t nem t�r�lhetsz a list�r�l" );
define( "LM_ERROR_SENDING_UNSUBSCRIBE", "Nem lehetett elk�ldeni a lemond�si �zenetet:" );
define( "LM_SUCCESS_UNSUBSCRIBE", "C�medet t�r�lt�k a nyilv�ntart�sunkb�l" );
define( "LM_SUCCESS_CONFIRMATION", "Fi�kod l�trehoz�s�nak j�v�hagy�sa siker�lt" );
define( "LM_ERROR_CONFIRM_ACC_NOTFOUND", "Nem tal�lhat� a j�v�hagy�si hivatkoz�shoz kapcsol�d� fi�k." );

define( "LM_CONFIRMED_ACCOUNTS_ONLY", "Csak a j�v�hagyott fi�kok?" );
define( "LM_CONFIRMED_ACCOUNTS_ONLY_TIP", "A h�rlev�l k�ld�se csak a <strong>j�v�hagyott</strong> megrendel�knek. Azok a megrendel�k, akik nem hagyt�k j�v� a megrendel�s�ket, nem kapnak h�rlevelet." );

define( "LM_NAME_TAG_USAGE", "A h�rlev�l tartalm�ban a <strong>[NAME]</strong> c�mk�vel k�ldhetsz szem�lyre szabott h�rleveleket. <br/>A h�rlev�l post�z�sakor a [NAME] a felhaszn�l�/megrendel� nev�vel ker�l behelyettes�t�sre." );

define( "LM_USERS_TO_SUBSCRIBERS", "A felhaszn�l�k megrendel�v� t�tele" );
define( "LM_ASSIGN_USERS", "Felhaszn�l�k hozz�rendel�se" );

/**
 * @since Letterman 1.2.0
 */
define( 'LM_SEND_LOG', 'Letterman h�rlev�lk�ld�si napl�' );
define( 'LM_NUMBER_OF_MAILS_SENT', 'Eddig %s / %s lev�l ker�lt elk�ld�sre.');
define( 'LM_SEND_NEXT_X_MAILS', 'Kattints a gombra a k�vetkez� %s lev�l elk�ld�s�hez.');
define( 'LM_CHANGE_MAILS_PER_STEP', 'A l�p�senk�nti �zenetek sz�m�nak m�dos�t�sa');
define( 'LM_CONFIRM_ABORT_SENDING', 'Val�ban meg akarod szak�tani a h�rlev�l post�z�s�t?');
define( 'LM_MAILS_PER_STEP', 'H�ny lev�l k�ldend� el egyszerre?');
define( 'LM_CONFIRM_UNSUBSCRIBE', 'T�nyleg le akarod mondani a h�rlevel�nket?');

?>
