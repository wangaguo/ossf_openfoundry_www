<?php

// --------------------------
// GLOBAL - global strings are used throughout GroupJive
// --------------------------

define('GJ_CREATEGROUP','<strong>Maak je EIGEN groep!</strong>');
define('GJ_BACK','<~Terug');
define('GJ_MEMBERS','Groepsleden');
define('GJ_CURRENT_USER','Leden');
define('GJ_MEMBER','Groepslid');
define('GJ_USERNAME','Gebruikersnaam');
define('GJ_REGISTERED','Geregistreerd');
define('GJ_USERONLINE','ONLINE');
define('GJ_USEROFFLINE','OFFLINE');

define('GJ_GROUPNAME','Groepsnaam');
define('GJ_GROUPDESCR','Over deze groep...');
define('GJ_CATEGORY_GR','Groepscategorie');
define('GJ_TYPE','Groepstype');
define('GJ_LOGO','Groepslogo');

define('GJ_DELETE','Verwijder');

define('GJ_OPEN','Open voor iedereen');
define('GJ_APREQUIRED','Goedkeuring nodig om lid te worden');
define('GJ_PRIVATE','Uitnodiging voor lidmaatschap');

define('GJ_SUBMIT','Verstuur');
define('GJ_REQ','Verplicht');
define('GJ_TITLE','Groepen');
define('GJ_SHOWALL','Laat alle bestaande groepen zien');
define('GJ_PAGE','Pagina\'s');
define('GJ_BACK_MAIN_PAGE','Terug naar groepsoverzicht');


// Show Overview (showoverview)
define('GJ_GROUP_CATEGORY','Groeps categorie&euml;n');

// Show Categorie (showcat)
define('GJ_SIMPLE_WELCOME','WELCOME BIJ DE GROEPEN');
define('GJ_SIMPLE_DESCR','Je kunt groepen bekijken, er lid van worden of je eigen groep oprichten.');
define('GJ_CUR_GROUPS','Online Groepen');
define('GJ_YOU_ARE_ADMIN','Je bent de administrator van deze groep!');
define('GJ_ALREADY_MEMBER','Je bent lid van deze groep!');

define('GJ_CREATED','Opgericht');

// Search
define('GJ_SEARCH_GROUP','Zoek een groep...');
define('GJ_SEARCH','Zoek');
define('GJ_SEARCH_RESULTS','Dit zijn je zoekresultaten');
define('GJ_NO_RESULTS','Er zijn geen groepen gevonden met de woorden waar je op gezocht hebt...');

// Groep creation responses
define('GJ_GROUP_WAS_CREATED','Het oprichten van de groep is gelukt.');

define('GJ_CAT_HASNT_G','Geen zichtbare groepen! Richt indien nodig zelf een groep op <br />
of neem contact op met de website administratie om opgerichte groep(en) zichtbaar te maken.');


// --------------------------
// GENERAL WARNING AND ERROR MESSAGES
// --------------------------
define('GJ_PLEASE_LOGIN', 'Je zult moeten inloggen, lid worden of opnieuw lid worden.');
define('GJ_NO_GROUPS','Geen zichtbare groepen. Je zult moeten inloggen, een groep oprichten of lid worden van een bestaande groep.');
define('GJ_NOTAUTH','Hallo. Ben je ingelogd?<br />Zo niet, log dan eerst in en bevestig vervolgens lidmaatschap van de groep.');
define('GJ_ONLY_CURRENT','Error! Alleen ingelogde leden die lid zijn hebben toegang tot deze groep.');

define('GJ_NO_CAT','Er zijn nog geen groepcategorie&uml;n aangemaakt! Gebruik de administratiemodule om categorie&uml;n aan te maken.');
define('GJ_GROUP_NOT_EXISTS','Error! Deze groep lijkt niet te bestaan! Wellicht is de groep nog niet geactiveerd?');

define('GJ_NO_USERS_FOUND', 'Geen leden gevonden');
define('GJ_NOT_VALID_EMAIL','Dit is geen valide email adres.');
define('GJ_FILL_REQ','Error! Vul alsjeblieft alle verplichte velden in.');

define('GJ_PAGE_NOT_EX','Error! Die pagina bestaat niet.');


// --------------------------
// GROUP PAGES
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_FOUNDED','Opgericht');
define('GJ_CREATOR','Groepsmanager');

define ('GJ_NEWESTMEM', 'Nieuwste lid');

define ('GJ_LATESTBULLETIN', 'Nieuwste bulletin');

define ('GJ_LATESTFORUM', 'Nieuwste forum posten');
define('GJ_DATE','Datum');


// Groep Function Navigation
define('GJ_GROUP_FUNCTIONS','Groepsactiviteiten');
define('GJ_GROUP_BUL','Groepsbulletins');
define('GJ_GROUP_EVENT','Groepsevenementen ~>');
define('GJ_GROUP_FORUM','Groepsforum ~>');
define ('GJ_BACKTGROUP', '<~ Terug naar groep');


// Join, Invite and Unjoin Groeps
define('GJ_SIGN','Word lid van deze groep');
define('GJ_INVITE','Nodig anderen uit (+)');
define('GJ_LEAVE_GROUP','Verlaat deze groep (-)');


//Open to join
define('GJ_WELCOME','Welkom! Lid worden van deze groep is gelukt!');


// Email Confirmation from *Open to join* Groeps
define('GJ_NEW_MEMBER','Welkom,<br />
<br />
<br />
Deze email is een bevestiging dat <em>%to_name</em> lid is geworden van de groep: <strong>%group_name</strong>.<br/>
<br/>
<br/>Welkom bij deze groep.<br/>
<br/>
<br/>
------- <em><small>einde bevestiging</small></em> ------- <br />
<em><small>Dit bericht is automatisch gegenereerd.</small></em>
');


//Approval to join
define('GJ_YOU_ARE_SIGN_ALREADY','Je bent al lid van deze groep! Misschien is je lidmaatschap nog niet bevestigd? Neem voor verdere hulp contact op met de administrator van de groep.');

define('GJ_WELCOME2','Dank je! De groepsadministrator moet je lidmaatschap eerst goedkeuren <em>(en inloggen voor jou mogelijk maken)</em>. Een verzoek hiertoe is reeds verstuurd.');
define('GJ_PENDING','Je verzoek om lid te worden is in behandeling.');

define('GJ_INVITE_ONLY','Lidmaatschap alleen mogelijk na persoonlijke uitnodiging');


// Invite to join
define('GJ_FR_NAME','Selecteer contacten op naam (moeten lid zijn van de site!)');
define('GJ_FR_EMAIL','Of stuur uitnodiging per email (voor niet-leden van deze site).');

define('GJ_USER_NOT_EXISTS','Error! Deze gebruikersnaam bestaat niet.');
define('GJ_USER_IN_GROUP','Error! Deze persoon is al lid van deze groep (of deze is al uitgenodigd of het lidmaatschap is nog niet geactiveerd).');

define('GJ_INVITE_WAS_SENT','Uitnodiging is verstuurd!');
define('GJ_YOU_WAS_INVITED','Je bent uitgenodigd');

define('GJ_INVITE_NOT_EXIST','Error! Uitnodiging kan niet gelezen worden. <br />
Check of je nog ingelogd bent en probeer het dan opnieuw.');


// Invitation Email to member
define('GJ_HELLO','Hallo %to_name,<br />
<br />
<br />
Je hebt een <em>uitnodiging</em> ontvangen van <em>%from_name</em> om lid te worden van de groep <strong>%group_name</strong>.<br/>
<br/>
<br/> Om deze uitnodiging aan te nemen, <big>ga naar %link.</big><br/>
<br/>
<br/>
------- <em><small>einde uitnodiging</small></em> ------- <br />
<em><small>Dit bericht is automatisch gegenereerd.</small></em>
');


// Invitation Email to non-member
define('GJ_INVITE_NONMEMBER','Hallo.<br />
<br />
<br />
Je hebt een <em>uitnodiging</em> ontvangen van <em>%from_name</em> om lid te worden van de groep <strong>%group_name</strong> op de website %s .
<br/>
<br/> Om deze uitnodiging aan te nemen, <big>ga naar %link.</big><br/>
<br/>
<br/>
------- <em><small>einde uitnodiging</small></em> ------- <br />
<em><small>Dit bericht is automatisch gegenereerd.</small></em>
');


// Invitation PMS
define('GJ_HELLO_UDDEIM','Hallo, %to_name. Je bent uitgenodigd door %from_name van de %group_name groep.<br/> Klik op de deze link om de uitnodiging te accepteren: %link.');
define('GJ_HELLO_JIM','Hallo, %to_name. Je bent door %from_name uitgenodigd om lid te worden van de %group_name groep. Als je deze uitnodiging wilt accepteren, kopieer dan onderstaande link en open die in je internet browser: %link');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','Wil je je echt uit deze groep uitschrijven?');
define('GJ_U_LEFT','Je bent uitgeschreven uit deze groep.');



// --------------------------
// GROUP MODERATOR
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

// Groep Moderator Navigation
define('GJ_INACTIVE_USERS','ACTIVATE <em>leden in wachtrij</em>');
define('GJ_EDIT_GROUP_INFO','EDIT <em>Bewerk groepsinfo</em>');
define('GJ_MAIL_GROUP', 'EMAIL <em>iedereen in deze groep</em>');
define('GJ_TRANSFER_OWNER', 'TRANSFER <em>naar nieuwe eigenaar</em>');
define('GJ_DELETE_GROUP','DELETE <strike>deze groep</strike>');

// Activate pending users (tmpl inactive)
define('GJ_INACTIVE_NAME','Leden in wachtrij');
define('GJ_INACTIVE_STATUS','Activatie status');
define('GJ_INACTIVE_ACTIONS','Moderator acties');

define('GJ_MAKE_ACTIVE','Lidmaatschap activeren!');

// Email the Groep
define('GJ_MAILS_WERE_SENT','Email verzonden naar leden van de groep.');
define('GJ_NO_INPUT', 'Niets ingevoerd');
define('GJ_MAIL_NO_SUBJECT','Geen onderwerp');
define('GJ_MAIL_NO_BODY', 'Berichtenveld mag niet leeg zijn');
define('GJ_MAIL_SUBJECT','Onderwerp');
define('GJ_MAIL_BODY','Bericht tekst');
define('GJ_MAIL_CC_MOD','Dit vakje aanvinken om een kopie naar de moderator te versturen.');


// Groep Moderator Functions
define('GJ_MODER_FUNCTION','Moderator taken');
define('GJ_NOT_MODER','Error! Je bent niet de moderator van deze groep.<br /> ...of ben je niet ingelogd?');


define('GJ_NEW_USERS_NEED_ACTIVATION','Nieuwe leden hebben zich aangemeld voor je groep. Activeer hun lidmaatschap alsjeblieft.');

define('GJ_NOT_INACTIVE','Er zijn geen inactieve leden.');

define('GJ_IS_ACT_NOW','Lidmaatschap is geactiveerd.');
define('GJ_IS_INACT_NOW','Lidmaatschap is gedeactiveerd.');
define('GJ_MAKE_INACTIVE','Deactiveer lidmaatschap');

define('GJ_GROUP_WAS_CREATED_APP','De groep is opgericht. De website administratie moet nu nog toestemming verlenen en de groep activeren.');

define('GJ_GROUP_INFO_WAS_EDITED','Groepsinformatie is gewijzigd!');

define('GJ_TRANSFERRED','Deze groep is overgedragen aan een nieuwe eigenaar!');
define('GJ_TRANS_TO_MBR_RQD','Sorry, de bedoelde persoon moet eerst lid worden van deze groep!');

define('GJ_DELETE_U_CONFIRM','Graag bevestigen: weet je zeker dat je dit lid wilt VERWIJDEREN?');
define('GJ_USER_WAS_DELETED','Dit lid is verwijderd uit je groep!');
define('GJ_DELETE_G_CONFIRM','Graag bevestigen: weet je zeker dat je deze groep wilt VERWIJDEREN?');
define('GJ_GROUP_WAS_DELETED','Deze groep is verwijderd en bestaat nu niet meer!');

define('GJ_MES_WAS_EDITED','Het bericht is gewijzigd.');
define('GJ_MES_WAS_DELETED','Het bericht is verwijderd.');
define('GJ_MESSAGE_NOT_EXISTS','Error! Het bericht bestaat niet!');


//ORPHAN?
define('GJ_GO_TO','Breng me naar mijn nieuwe groep!');
//ORPHAN?

//ORPHAN?
define('GJ_GROUP_APPROVAL','Dankjewel. De website administratie zal bekijken of je nieuwe groep goedgekeurd kan worden.');
//ORPHAN?

//ORPHAN?
define('GJ_GROUPNAME_EXISTS','Er bestaat al een groep met deze naam. Richt je groep op onder een andere naam.');
//ORPHAN?

//ORPHAN?
define('GJ_STANDARD_FUNCTION','Standaard functies');
//ORPHAN?

//ORPHAN?
define('GJ_U_G','Er is geen overeenkomst gevonden met deze persoon en groep.');
//ORPHAN?


// --------------------------
// BULLETIN FUNCTIONS
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_ARCHIVE','Toon volledig bulletin archief in');
define('GJ_ADD_POST_IN_BUL','Nieuw bericht toevoegen aan bulletins');
define('GJ_MESSAGE_WAS_ADDED','Het bericht is geplaatst als nieuw groepsbulletin.');
define('GJ_EDIT','Wijzig deze bulletin');


// Bulletin view
define('GJ_HTML_NOT_ALLOW','<em>HTML code niet toegestaan in bulletins</em>');
define('GJ_AUTHOR','Auteur');
define('GJ_SUBJECT','Bulletin titel');
define('GJ_LEAVE_MESSAGE','Schrijf je bulletin');
define('GJ_BY','door');
define('GJ_POST','Post');
define('GJ_MESSAGE','Bericht');

define('GJ_NO_MESSAGE','<em>Er zijn geen nieuwe berichten in de groepsbulletins.</em>');
define('GJ_ONLY_MEMBERS_CAN_POST', 'Allen groepsleden kunnen een bulletin schrijven.');
define('GJ_MES_COULD_NOT_DELETED', 'Bulletin kon niet verwijderd worden!');
define('GJ_NO_BULLETIN_AVAILABLE','Groepsbulletins momenteel niet beschikbaar.');

// Bulletin Email
define('GJ_BULLETIN_LINKTEXT','Click HERE to visit this Group online, make comments, and more...~>');

// Bulletin Email
define('GJ_NEW_BUL','Hello %to_name, <br />
<br />
<strong>%from_name</strong> has posted a new bulletin in the group <big><em>%group_name</em></big>. <br />
&nbsp;<br />
&nbsp;<br />
<em>= = =  New Bulletin = = =</em><br />

<br />
%p
<br />
<br />
- - - - <em><small>end bulletin</small></em> - - - - <br />
&nbsp;<br />
&nbsp;<br />
&nbsp;<br />
Link to Bulletin: <br />
<big>%link </big><br />
<br />
<em><small>* This message was generated automatically.</small></em>');

/**
define('GJ_NEW_BUL','Hallo, <br />
<br />
<strong>%s</strong> heeft een nieuw bulletin geplaatst in de groep <big><em>%s</em></big>. <br />
<br />
<br />
= = =  BULLETIN = = = <br />

<br />
%s <br />
------- <em><small>einde bulletin</small></em> ------- <br />
<br />
<br />
Link: %s<br />

<em><small>Dit bericht is automatisch gegenereerd.</small></em>');

**/


// --------------------------
// EVENT FUNCTIONS
// --------------------------


// --------------------------
// FORUM FUNCTIONS
// --------------------------

define('GJ_NO_FORUM_POSTS','<em>Er zijn nog geen forumberichten geplaatst.</em>');



// --------------------------
// ADMINISTRATOR
// --------------------------

define('GJ_GR_CUR_CAT','Huidige categorie&euml;n');
define('GJ_ADD','Voeg categorie toe');
define('GJ_CAT_WAS_W','Categorie toegevoegd');
define('GJ_CAT_WAS_EDITED','Categorie gewijzigd');
define('GJ_WAS_DELETED','Categorie verwijderd');
define('GJ_CAT_NOT_EX','Categorie bestaat niet');
define('GJ_CAT_AL_EXF','Er bestaat al een categorie met deze naam');

define('GJ_NO_CAT_SELECTED', 'Geen categorie geselecteerd');
define('GJ_NO_CAT_AVAILABLE', 'Geen gepubliceerde categorie beschikbaar - cre&euml; er eerst tenminste een.');


define('GJ_NO_GROUPNAME', 'Groepsnaam is niet ingevuld');
define('GJ_GR_WAS_ACTIVED','Groep(en) nu geactiveerd');
define('GJ_GR_WAS_DEACTIVED','Groep(en) verbannen');
define('GJ_GR_WAS_DEL','Groep(en) verwijderd!');
define('GJ_GR_N_EX','Groep bestaat niet');

define('GJ_ACTIVITY','Groepsactiviteit');
define('GJ_INVITED','Groepsuitnodiging');

define('GJ_NO_ADMIN','Geen administrator toegwezen');
define('GJ_FILL_ALL','Vul alsjeblieft alle velden in');

define('GJ_SET_UPD','Instellingen vernieuwd');

// ORPHAN?
define('GJ_INT_T','Values of fields groups on page, messages on frontpage should be integer');
// ORPHAN?

// Admin email notification
define('GJ_NEWGROUPCREATED','Hallo administrator,<br />
<br />
<br />
Er is een nieuwe groep opgericht in GroupJive!<br/>
<br/>
<br/> 
Ga alsjeblieft naar de website om nieuwe GroupJive Groep(en) te bekijken en eventuele administratieve handelingen zoals activeren e.d. uit te voeren.<br/>
<br/>
<br/>
Bedankt.
<br/>
<br/>
------- <em><small>einde admin notificatie</small></em> ------- <br />
<em><small>Dit bericht is automatisch gegenereerd.</small></em>
');


//------------------------------
//   MODULE LANGUAGE STRINGS
//------------------------------
define('GJ_MODULE_NO_GROUPS','Je bent geen lid van een van deze groepen.');

?>
