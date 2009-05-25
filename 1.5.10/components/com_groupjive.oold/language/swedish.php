<?php
// --------------------------// GLOBAL - global strings are used throughout GroupJive// --------------------------// Redigerad av Ola@intelligentmammals.se, 2007-12-09, // http://www.intelligentmammals.se/
// Please note that this file should be saved as "ISO Latin 1" (aka iso-8859-1)define('GJ_CREATEGROUP','<b>Skapa en egen grupp!</b>');define('GJ_BACK','<-Gå tillbaka');/* please not usage of Member and Group Members is for singular and/or plural instances when needed. */define('GJ_MEMBER','Medlem');define('GJ_MEMBERS','Medlemmar');define('GJ_CURRENT_USER','Medlemmar');define('GJ_USERNAME','Användarnamn');define('GJ_REGISTERED','Registrerad');define('GJ_USERONLINE','ONLINE');define('GJ_USEROFFLINE','OFFLINE');define('GJ_GROUPNAME','Gruppnamn');define('GJ_GROUPDESCR','Om gruppen');define('GJ_CATEGORY_GR','Gruppkategori');define('GJ_TYPE','Grupptyp');define('GJ_LOGO','Grupplogotyp');define('GJ_DELETE','Radera');define('GJ_OPEN','Öppen');define('GJ_APREQUIRED','Medlemskap efter ansökan');define('GJ_PRIVATE','Privat');define('GJ_MAIL_OWNER','Maila gruppadmin');define('GJ_ERROR_MAIL_OWNER','maila gruppadmin?');define('GJ_SUBMIT','Skicka');define('GJ_REQ','Obligatoriskt');define('GJ_TITLE','Användargrupper');define('GJ_SHOWALL','Visa alla existerande grupper');define('GJ_PAGE','Sidor');define('GJ_BACK_MAIN_PAGE','Tillbaka till gruppadmin-sidan');


define('GJ_CREATEGROUP_PATH','Skapa ny grupp');define('GJ_ERROR_INTRO',' Kontrollera detta meddelande: ');define('GJ_NO_GROUP_WITH_THAT_ID','Det finns ingen grupp med det IDt.');define('GJ_ERROR_JOIN_GROUP_L1','Hejsan, denna grupps medlemmar måste godkännas. <br /> Du är inte medlem ännu. ');define('GJ_ERROR_JOIN_GROUP_L2',' Du kan ansöka om att bli medlem i gruppen. <br /> Administratören kommer att behandla din ansökan och svara på den.');// Show Overview (showoverview)define('GJ_GROUP_CATEGORY','Kategorier av grupper');// Show Category (showcat)define('GJ_SIMPLE_WELCOME','VÄLKOMMEN TILL GRUPPER');define('GJ_SIMPLE_DESCR','Du kan besöka, gå med i grupper eller skapa egna.');define('GJ_CUR_GROUPS','Existerande grupper');define('GJ_YOU_ARE_ADMIN','Du är admin för denna grupp!');define('GJ_ALREADY_MEMBER','Du är medlem i denna grupp!');define('GJ_CREATED','Skapad');


// Searchdefine('GJ_SEARCH_GROUP','Sök efter grupper...');define('GJ_SEARCH','Sök');define('GJ_SEARCH_RESULTS','Här är dina sökresultat');define('GJ_NO_RESULTS','Inga grupper hittades med de sökord du angav');// Group creation responsesdefine('GJ_GROUP_WAS_CREATED','Gruppen har skapats.');define('GJ_CAT_HASNT_G','Det finns inga grupper i denna kategori ännu. Skapa gärna en grupp <br />om den saknas eller kontakta admin för att publicera en grupp.');

// --------------------------//  MESSAGES: DEFAULT MESSAGES AND ERROR MESSAGES// --------------------------define('GJ_PLEASE_LOGIN','Logga in är första steget, sedan kan du gå med i grupper.');define('GJ_NO_GROUPS','Inga synliga grupper. Du kanske behöver logga, skapa eller gå med i grupper.');define('GJ_NOTAUTH','Hejsan. Är du inloggad?<br />Kontrollera din inlogging och sedan dina gruppmedlemskap.');define('GJ_ONLY_CURRENT','Bara inloggade gruppmedlemmar kan använda denna funktion');define('GJ_NO_CAT','Det finns ingen kategori ännu. Var god skapa minst en kategori i administrationspanelen i backend.');define('GJ_GROUP_NOT_EXISTS','Tillgång till denna grupp är <br /> inte möjlig just nu!<br /> Kanske du inte är medlem i denna grupp?<br />... eller kanske gruppen behöver aktiveras av en gruppadmin?<br /><br /> <small><em>Användare som just ansökt om medlemskap får detta fel <br /> tills gruppadmin svarat på ansökan.</em></small>');define('GJ_NO_USERS_FOUND','Inga användare hittades.');define('GJ_NOT_VALID_EMAIL','Det där är inte en korrekt epostadress');define('GJ_MAILS_WERE_SENT','Epost skickades.');define('GJ_MAILS_WERE_NOT_SENT','OBS!!! - ledsen men ditt email skickades inte. Kontakta gärna Admin.');define('GJ_FILL_REQ','OBS! Vad vänlig och fyll i alla fält som krävs.');define('GJ_PAGE_NOT_EX','Sidan existerar inte');

// --------------------------// GROUP PAGES// --------------------------// note: look top of page in GLOBAL for additional strings not shown belowdefine('GJ_FOUNDED','Grundad');define('GJ_CREATOR','Grundare');define('GJ_NEWESTMEM','Nyaste medlem');define('GJ_LATESTBULLETIN','Senaste meddelande');define('GJ_LATESTFORUM','Senste forum');define('GJ_DATE','Datum');// Group Function Navigationdefine('GJ_GROUP_MENU','Meny');define('GJ_GROUP_INFO','Info');define('GJ_GROUP_LOGO','Logo');define('GJ_GROUP_FUNCTIONS','Gruppaktiviteter');define('GJ_GROUP_BUL','Gruppbulletin');define('GJ_GROUP_EVENT','Gruppevenemang');define('GJ_GROUP_FORUM','Gruppforum');define('GJ_BACKTGROUP','Tillbaka till grupp');define('GJ_BACKTGROUPVIEW','Tillbaka till gruppöversikt');// Join, Invite and Unjoin Groupsdefine('GJ_SIGN','Gå med i gruppen!');define('GJ_INVITE','Bjud in dina vänner');define('GJ_INVITE_PEOPLE','Bjud in registerad användare:');define('GJ_LEAVE_GROUP','Lämna grupp (-)');//Open to joindefine('GJ_WELCOME','Du är nu medlem av den här gruppen. Välkommen!');




// Email Confirmation to Users/Moderators about Users *JOINING* Groupsdefine('GJ_NEW_MEMBER','Hejsan %to_name,<br /><br /><br />Detta email är din bekräftelse på att <em>%from_name</em> har blivit medlem i gruppen <strong>%group_name</strong>.<br /><br /><br /><big>Till alla nya medlemmar: Välkommen till gruppen!</big><br/><br /><br /><br />Tack och välkommen till gruppen.<br /><br /><br /><br />&nbsp;<br /><small>- OBS:<br />- ÖPPNA grupper: Användare som ansöker om medlemskap blir medlemmar direkt.<br />- KRÄVER GODKÄNNANDE grupper: Användare som ansöker om medlemskap var vänlig vänta. Gruppadmins kommer att svara på din ansökan och godkänna ditt medlemskap så fort som möjligt.<br />- Tack.</small><br /><br />- - - - - - <em><small>Slut på meddelandet</small></em> - - - - - - <br /><em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');//Approval to joindefine('GJ_YOU_ARE_SIGN_ALREADY','Du är redan medlem i den gruppen. Kanske har ditt medlemskap inte aktiverats? Kontakta gruppadmin!');define('GJ_WELCOME2','Den här gruppen kräver godkännande av gruppadmin för medlemskap. Tack för din ansökan som nu kommer att behandlas.');define('GJ_PENDING','Din ansökan är under behandling och väntar på godkännande.');define('GJ_INVITE_ONLY','Medlemskap endast genom inbjudan');


// Invite to joindefine('GJ_FR_NAME','Vännens användarnamn (måste vara registrerad)');define('GJ_FR_EMAIL','Eller bjud in via epostadress (för personer som inte registrerat sig på siten)');define('GJ_USER_NOT_EXISTS','Den användaren existerar inte.');define('GJ_USER_IN_GROUP','Den användaren är redan medlem i den här gruppen (deras medlemskap kan vara inaktivt).');define('GJ_INVITE_WAS_SENT','Inbjudan har skickats');define('GJ_YOU_WAS_INVITED','Du är inbjuden');define('GJ_INVITE_NOT_EXIST','Inbjudan existerar inte. Kontrollera att du är inloggad och prova igen.');// Invitation Email to memberdefine('GJ_HELLO','Hejsan %to_name,<br /><br /><br />Du har fått en inbjudan att gå med i en grupp från <em>%from_name</em>.<br/><br/> Du måste klicka på denna länk <big>%link.</big></big></em> för att aktivera ditt medlemskap och gå med i gruppen. Denna länk är enda metoden att aktivera ditt medlemskap. Om du besöker gruppen (utan aktivering) måste du återvända till detta email för att gå med. <br/><br/><br/><strong>%group_name</strong> är gruppen du har blivit inbjuden till. Klickar du på gruppens namn kan du besöka gruppen, men endast om den är ÖPPEN. Att besöka gruppen betyder inte att du blir medlem eller aktiverar ditt medlemskap. <br/><br/><br/>------- <em><small> Slut på inbjudan</small></em> ------- <br /><em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');



// Invitation Email to non-member

define('GJ_INVITE_NONMEMBER','Hejsan,<br />

<br /> Detta email är en <strong>inbjudan</strong>.

<br />

<br />

Du har fått en inbjudan att gå med i en grupp från <em>%from_name</em>.

<br />

<br />
För att besöka denna grupp, klicka på denna länk: <big>%group_name</big>. Notera att du måste <em> logga in</em> före du går med i grupper du har blivit inbjuden till!

<br />

<br />

Grupper delar gemensamma intressen som tex diskussionsforum, gruppevenemang, meddelanden med mera. Du kan besöka  %link när du vill på %s .

<br />

<br />

Tack.

<br />

<br />

<br />

------- <em><small>Detta är en inbjudan.n</small></em> ------- <br />

<em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>

');



// Invitation PMS

define('GJ_HELLO_UDDEIM','Hej, %to_name. Du har bjudits in av %from_name till gruppen %group_name. Om du vill gå med i gruppen, var god gå till %link.');

define('GJ_HELLO_JIM','Hej, %to_name. Du har bjudits in av %from_name till gruppen %group_name. Om du vill gå med i gruppen, var god kopiera denna URL till din webbläsares adressfönster %link.');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','Vill du verkligen lämna denna grupp?');

define('GJ_U_LEFT','<big><em>Du har nu lämnat denna grupp.</em></big>');




// --------------------------

// GROUP MODERATOR

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below


// Group Moderator Navigation

define('GJ_INACTIVE_USERS','Inaktiva medlemmar');
define('GJ_EDIT_GROUP_INFO','Redigera gruppinformation');
define('GJ_MAIL_GROUP','Maila <em>alla i gruppen</em>');

define('GJ_TRANSFER_OWNER','Överför ägarskap <em>till ny ägare</em>');

define('GJ_DELETE_GROUP','Radera <strike>denna grupp</strike>');

// Activate pending users (tmpl inactive)

define('GJ_INACTIVE_NAME','Medlemskap att godkänna');

define('GJ_INACTIVE_STATUS','Aktiveringsstatus');

define('GJ_INACTIVE_ACTIONS','Gruppadmin åtgärder');

define('GJ_MAKE_ACTIVE','Aktivera användare!');


// Email the Group
define('GJ_NO_INPUT','Input saknas');

define('GJ_MAIL_NO_SUBJECT','Ingen ärenderad');

define('GJ_MAIL_NO_BODY','Meddelandet kan inte vara tomt');

define('GJ_MAIL_SUBJECT','Ärenderad');

define('GJ_MAIL_BODY','Meddelandetext');

define('GJ_MAIL_CC_MOD','Kryssa för denna för att skicka kopia till gruppadmin');




// Group Moderator Functions

define('GJ_MODER_FUNCTION','Administratörers uppgifter');

define('GJ_MODER_PROFILE','Administratörerns profil: ');

define('GJ_MODER_FUNC_BLANK','...denna meny är tom<br /> om användaren inte är en administratör');

define('GJ_NOT_MODER','OBS! Du är inte admin för denna grupp.<br /> ...eller så är du inte inloggad?');



define('GJ_NEW_USERS_NEED_ACTIVATION','Nya användare grupper har gått med i din grupp, vänligen aktivera dem.');

define('GJ_NOT_INACTIVE','Det finns inga inaktiva medlemmar.');


define('GJ_IS_ACT_NOW','Medlemmen är nu aktiv.');
define('GJ_IS_INACT_NOW','Medlemmen är nu inaktiv.');
define('GJ_MAKE_INACTIVE','Inaktivera');


define('GJ_GROUP_WAS_CREATED_APP','Gruppen har skapats. Var god vänta på administratorens godkännande.');


define('GJ_GROUP_INFO_WAS_EDITED','Gruppinformationen har redigerats');


define('GJ_TRANSFER_OWNER_HEADER','Överför gruppen till ny gruppadmin :');

define('GJ_TRANSFERRED','Ägarskapen för gruppen har överförts!');

define('GJ_TRANS_TO_MBR_RQD','Ledsen, den nya gruppadmin måste vara medlem i gruppen.!');


define('GJ_DELETE_U_CONFIRM','Vänligen bekräfta att du vill radera denna användare?');

define('GJ_USER_WAS_DELETED','Användaren raderades från gruppen.');
define('GJ_DELETE_G_CONFIRM','Vänligen bekräfta att du vill radera denna grupp?');

define('GJ_GROUP_WAS_DELETED','Gruppen har raderats!');

define('GJ_MES_WAS_EDITED','Meddelandet har redigerats.');

define('GJ_MES_WAS_DELETED','Meddelandet har raderats.');

define('GJ_MESSAGE_NOT_EXISTS','Meddelandet existerar inte.');


//ORPHAN?
define('GJ_GO_TO','Till min nya grupp');

//ORPHAN?

//ORPHAN?

define('GJ_GROUP_APPROVAL','Tack. Denna grupp kommer nu att ses över av sitens administratör för godkännande.');

//ORPHAN?

//ORPHAN?

define('GJ_GROUPNAME_EXISTS','En grupp med det namnet finns redan. Var vänlig skapa den igen med ett nytt namn.');

//ORPHAN?


//ORPHAN?

define('GJ_STANDARD_FUNCTION','Standard funktioner');

//ORPHAN?

//ORPHAN?

define('GJ_U_G','En match mellan den användaren och den gruppen kunde inte hittas.');
//ORPHAN?



// --------------------------

// BULLETIN FUNCTIONS

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below


define('GJ_MOSTRECENT_BUL','(nyaste posterna)');
define('GJ_ARCHIVE','>> GÅ till det kompletta arkivet för');

define('GJ_ADD_POST_IN_BUL','Lägg till nytt meddelande i gruppens anslagstavla');

define('GJ_MESSAGE_WAS_ADDED','Meddelandet lades till gruppens anslagstavla');

define('GJ_EDIT','Redigera');




// Bulletin view

define('GJ_HTML_NOT_ALLOW','HTML är inte tillåtet');
define('GJ_AUTHOR','Skribent');

define('GJ_COMPOSE_BULLETIN','Skapa anslag:');

define('GJ_SUBJECT','Anslagstavla');

define('GJ_SUBJECT_TITLE','Anslagets titel');

define('GJ_LEAVE_MESSAGE','Skriv ditt eget anslag');

define('GJ_BY','av');

define('GJ_POST','Posta');

define('GJ_MESSAGE','Meddelande');



define('GJ_NO_MESSAGE','Det finns inga anslag i gruppens anslagstavla');
define('GJ_ONLY_MEMBERS_CAN_POST','Endast gruppmedlemmar kan skapa anslag.');

define('GJ_MES_COULD_NOT_DELETED','Anslaget kunde inte raderas!');

define('GJ_NO_BULLETIN_AVAILABLE','Anslagstavlan är inte tillgänglig');





define('GJ_BULLETIN_LINKTEXT','Klicka här för att se alla anslag online, kommentera med mera...>');



// Bulletin Email

define('GJ_NEW_BUL','Hejsan %to_name, <br />

<br />

<strong>%from_name</strong> har postat ett nygg anslag i gruppen <big><em>%group_name</em></big>. <br />

&nbsp;<br />

&nbsp;<br />

<em>= = =  Nytt anslag = = =</em><br />



<br />

%p

<br />

<br />

- - - - <em><small>slut på anslag</small></em> - - - - <br />

&nbsp;<br />

&nbsp;<br />

&nbsp;<br />

Länk till Anslagstavla: <br />

<big>%link </big><br />

<br />

<em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');











// --------------------------

// EVENT FUNCTIONS

// --------------------------

define('GJ_LATEST_EVENTS','Senaste evenemang');

define('GJ_NO_EVENTS','<em>Det finns inga evenemang ännu.</em>');

define('GJ_EVENTS_ONLY_FOR_MEMBERS','Evenemang är endast för medlemmar.');



// --------------------------

// FORUM FUNCTIONS

// --------------------------



define('GJ_NO_FORUM_POSTS','<em>Det finns inga forummeddealanden ännu.</em>');





// --------------------------

// ADMINISTRATOR

// --------------------------



define('GJ_GR_CUR_CAT','Nuvarande kategorier');

define('GJ_ADD','Skapa kategori');

define('GJ_CAT_WAS_W','Kategori skapades');

define('GJ_CAT_WAS_EDITED','Kategori redigerades');

define('GJ_WAS_DELETED','Kategori raderades');

define('GJ_CAT_NOT_EX','Kategori finns inte');

define('GJ_CAT_AL_EXF','Kategori med det namn finns redan');



define('GJ_NO_CAT_SELECTED','Ingen kategori valdes');

define('GJ_NO_CAT_AVAILABLE','Inga publicerade kategorier finns - skapa minst en först.');





define('GJ_NO_GROUPNAME','Gruppnamn är tomt');

define('GJ_GR_WAS_ACTIVED','Grupp aktiverad');

define('GJ_GR_WAS_DEACTIVED','Grupp har bannats');

define('GJ_GR_WAS_DEL','Grupp har raderats.');

define('GJ_GR_N_EX','Grupp finns inte');



define('GJ_ACTIVITY','Gruppaktivitet');

define('GJ_INVITED','Gruppinbjudan');



define('GJ_NO_ADMIN','Ingen gruppadmin har tilldelats');

define('GJ_FILL_ALL','Vänligen fyll i alla fält');



define('GJ_SET_UPD','Inställningar uppdaterade');



// ORPHAN?

define('GJ_INT_T','Värden i fält bör vara heltal');

// ORPHAN?



// Admin email notification

//TRANSLATORS - PLEASE NOTE THE USE OF QUOTES "" AND THE \n TO CREATE LINE BREAKS IN THIS EMAIL ONLY. THANK YOU

define('GJ_NEWGROUPCREATED','"Hejsan gruppadmin \n

\n

En ny grupp har skapats.!\n

Vänligen besök webbsiten för att se den nya  gruppen och ta itu med administrativa uppgifter som krävs.\n

Tack.

\n

\n

------- slut på admin meddelande ------- \n

Detta meddelande skapades och skickades automatiskt."');







//------------------------------

//   MODULE LANGUAGE STRINGS

//------------------------------

define('GJ_MODULE_NO_GROUPS','Du är inte medlem av någon grupp.');

define('GJ_MODULE_MEMBERS','Medlemmar');

define('GJ_MODULE_MEMBER','Medlem');



define('GJ_ERROR_STATUS_ALREADY_SET','Status redan inställd!');

define('GJ_INVITE_LINKTEXT',' aktiveringssidan');



?> 