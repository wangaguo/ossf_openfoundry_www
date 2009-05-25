<?php
// --------------------------// GLOBAL - global strings are used throughout GroupJive// --------------------------// Redigerad av Ola@intelligentmammals.se, 2007-12-09, // http://www.intelligentmammals.se/
// Please note that this file should be saved as "ISO Latin 1" (aka iso-8859-1)define('GJ_CREATEGROUP','<b>Skapa en egen grupp!</b>');define('GJ_BACK','<-G� tillbaka');/* please not usage of Member and Group Members is for singular and/or plural instances when needed. */define('GJ_MEMBER','Medlem');define('GJ_MEMBERS','Medlemmar');define('GJ_CURRENT_USER','Medlemmar');define('GJ_USERNAME','Anv�ndarnamn');define('GJ_REGISTERED','Registrerad');define('GJ_USERONLINE','ONLINE');define('GJ_USEROFFLINE','OFFLINE');define('GJ_GROUPNAME','Gruppnamn');define('GJ_GROUPDESCR','Om gruppen');define('GJ_CATEGORY_GR','Gruppkategori');define('GJ_TYPE','Grupptyp');define('GJ_LOGO','Grupplogotyp');define('GJ_DELETE','Radera');define('GJ_OPEN','�ppen');define('GJ_APREQUIRED','Medlemskap efter ans�kan');define('GJ_PRIVATE','Privat');define('GJ_MAIL_OWNER','Maila gruppadmin');define('GJ_ERROR_MAIL_OWNER','maila gruppadmin?');define('GJ_SUBMIT','Skicka');define('GJ_REQ','Obligatoriskt');define('GJ_TITLE','Anv�ndargrupper');define('GJ_SHOWALL','Visa alla existerande grupper');define('GJ_PAGE','Sidor');define('GJ_BACK_MAIN_PAGE','Tillbaka till gruppadmin-sidan');


define('GJ_CREATEGROUP_PATH','Skapa ny grupp');define('GJ_ERROR_INTRO',' Kontrollera detta meddelande: ');define('GJ_NO_GROUP_WITH_THAT_ID','Det finns ingen grupp med det IDt.');define('GJ_ERROR_JOIN_GROUP_L1','Hejsan, denna grupps medlemmar m�ste godk�nnas. <br /> Du �r inte medlem �nnu. ');define('GJ_ERROR_JOIN_GROUP_L2',' Du kan ans�ka om att bli medlem i gruppen. <br /> Administrat�ren kommer att behandla din ans�kan och svara p� den.');// Show Overview (showoverview)define('GJ_GROUP_CATEGORY','Kategorier av grupper');// Show Category (showcat)define('GJ_SIMPLE_WELCOME','V�LKOMMEN TILL GRUPPER');define('GJ_SIMPLE_DESCR','Du kan bes�ka, g� med i grupper eller skapa egna.');define('GJ_CUR_GROUPS','Existerande grupper');define('GJ_YOU_ARE_ADMIN','Du �r admin f�r denna grupp!');define('GJ_ALREADY_MEMBER','Du �r medlem i denna grupp!');define('GJ_CREATED','Skapad');


// Searchdefine('GJ_SEARCH_GROUP','S�k efter grupper...');define('GJ_SEARCH','S�k');define('GJ_SEARCH_RESULTS','H�r �r dina s�kresultat');define('GJ_NO_RESULTS','Inga grupper hittades med de s�kord du angav');// Group creation responsesdefine('GJ_GROUP_WAS_CREATED','Gruppen har skapats.');define('GJ_CAT_HASNT_G','Det finns inga grupper i denna kategori �nnu. Skapa g�rna en grupp <br />om den saknas eller kontakta admin f�r att publicera en grupp.');

// --------------------------//  MESSAGES: DEFAULT MESSAGES AND ERROR MESSAGES// --------------------------define('GJ_PLEASE_LOGIN','Logga in �r f�rsta steget, sedan kan du g� med i grupper.');define('GJ_NO_GROUPS','Inga synliga grupper. Du kanske beh�ver logga, skapa eller g� med i grupper.');define('GJ_NOTAUTH','Hejsan. �r du inloggad?<br />Kontrollera din inlogging och sedan dina gruppmedlemskap.');define('GJ_ONLY_CURRENT','Bara inloggade gruppmedlemmar kan anv�nda denna funktion');define('GJ_NO_CAT','Det finns ingen kategori �nnu. Var god skapa minst en kategori i administrationspanelen i backend.');define('GJ_GROUP_NOT_EXISTS','Tillg�ng till denna grupp �r <br /> inte m�jlig just nu!<br /> Kanske du inte �r medlem i denna grupp?<br />... eller kanske gruppen beh�ver aktiveras av en gruppadmin?<br /><br /> <small><em>Anv�ndare som just ans�kt om medlemskap f�r detta fel <br /> tills gruppadmin svarat p� ans�kan.</em></small>');define('GJ_NO_USERS_FOUND','Inga anv�ndare hittades.');define('GJ_NOT_VALID_EMAIL','Det d�r �r inte en korrekt epostadress');define('GJ_MAILS_WERE_SENT','Epost skickades.');define('GJ_MAILS_WERE_NOT_SENT','OBS!!! - ledsen men ditt email skickades inte. Kontakta g�rna Admin.');define('GJ_FILL_REQ','OBS! Vad v�nlig och fyll i alla f�lt som kr�vs.');define('GJ_PAGE_NOT_EX','Sidan existerar inte');

// --------------------------// GROUP PAGES// --------------------------// note: look top of page in GLOBAL for additional strings not shown belowdefine('GJ_FOUNDED','Grundad');define('GJ_CREATOR','Grundare');define('GJ_NEWESTMEM','Nyaste medlem');define('GJ_LATESTBULLETIN','Senaste meddelande');define('GJ_LATESTFORUM','Senste forum');define('GJ_DATE','Datum');// Group Function Navigationdefine('GJ_GROUP_MENU','Meny');define('GJ_GROUP_INFO','Info');define('GJ_GROUP_LOGO','Logo');define('GJ_GROUP_FUNCTIONS','Gruppaktiviteter');define('GJ_GROUP_BUL','Gruppbulletin');define('GJ_GROUP_EVENT','Gruppevenemang');define('GJ_GROUP_FORUM','Gruppforum');define('GJ_BACKTGROUP','Tillbaka till grupp');define('GJ_BACKTGROUPVIEW','Tillbaka till grupp�versikt');// Join, Invite and Unjoin Groupsdefine('GJ_SIGN','G� med i gruppen!');define('GJ_INVITE','Bjud in dina v�nner');define('GJ_INVITE_PEOPLE','Bjud in registerad anv�ndare:');define('GJ_LEAVE_GROUP','L�mna grupp (-)');//Open to joindefine('GJ_WELCOME','Du �r nu medlem av den h�r gruppen. V�lkommen!');




// Email Confirmation to Users/Moderators about Users *JOINING* Groupsdefine('GJ_NEW_MEMBER','Hejsan %to_name,<br /><br /><br />Detta email �r din bekr�ftelse p� att <em>%from_name</em> har blivit medlem i gruppen <strong>%group_name</strong>.<br /><br /><br /><big>Till alla nya medlemmar: V�lkommen till gruppen!</big><br/><br /><br /><br />Tack och v�lkommen till gruppen.<br /><br /><br /><br />&nbsp;<br /><small>- OBS:<br />- �PPNA grupper: Anv�ndare som ans�ker om medlemskap blir medlemmar direkt.<br />- KR�VER GODK�NNANDE grupper: Anv�ndare som ans�ker om medlemskap var v�nlig v�nta. Gruppadmins kommer att svara p� din ans�kan och godk�nna ditt medlemskap s� fort som m�jligt.<br />- Tack.</small><br /><br />- - - - - - <em><small>Slut p� meddelandet</small></em> - - - - - - <br /><em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');//Approval to joindefine('GJ_YOU_ARE_SIGN_ALREADY','Du �r redan medlem i den gruppen. Kanske har ditt medlemskap inte aktiverats? Kontakta gruppadmin!');define('GJ_WELCOME2','Den h�r gruppen kr�ver godk�nnande av gruppadmin f�r medlemskap. Tack f�r din ans�kan som nu kommer att behandlas.');define('GJ_PENDING','Din ans�kan �r under behandling och v�ntar p� godk�nnande.');define('GJ_INVITE_ONLY','Medlemskap endast genom inbjudan');


// Invite to joindefine('GJ_FR_NAME','V�nnens anv�ndarnamn (m�ste vara registrerad)');define('GJ_FR_EMAIL','Eller bjud in via epostadress (f�r personer som inte registrerat sig p� siten)');define('GJ_USER_NOT_EXISTS','Den anv�ndaren existerar inte.');define('GJ_USER_IN_GROUP','Den anv�ndaren �r redan medlem i den h�r gruppen (deras medlemskap kan vara inaktivt).');define('GJ_INVITE_WAS_SENT','Inbjudan har skickats');define('GJ_YOU_WAS_INVITED','Du �r inbjuden');define('GJ_INVITE_NOT_EXIST','Inbjudan existerar inte. Kontrollera att du �r inloggad och prova igen.');// Invitation Email to memberdefine('GJ_HELLO','Hejsan %to_name,<br /><br /><br />Du har f�tt en inbjudan att g� med i en grupp fr�n <em>%from_name</em>.<br/><br/> Du m�ste klicka p� denna l�nk <big>%link.</big></big></em> f�r att aktivera ditt medlemskap och g� med i gruppen. Denna l�nk �r enda metoden att aktivera ditt medlemskap. Om du bes�ker gruppen (utan aktivering) m�ste du �terv�nda till detta email f�r att g� med. <br/><br/><br/><strong>%group_name</strong> �r gruppen du har blivit inbjuden till. Klickar du p� gruppens namn kan du bes�ka gruppen, men endast om den �r �PPEN. Att bes�ka gruppen betyder inte att du blir medlem eller aktiverar ditt medlemskap. <br/><br/><br/>------- <em><small> Slut p� inbjudan</small></em> ------- <br /><em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');



// Invitation Email to non-member

define('GJ_INVITE_NONMEMBER','Hejsan,<br />

<br /> Detta email �r en <strong>inbjudan</strong>.

<br />

<br />

Du har f�tt en inbjudan att g� med i en grupp fr�n <em>%from_name</em>.

<br />

<br />
F�r att bes�ka denna grupp, klicka p� denna l�nk: <big>%group_name</big>. Notera att du m�ste <em> logga in</em> f�re du g�r med i grupper du har blivit inbjuden till!

<br />

<br />

Grupper delar gemensamma intressen som tex diskussionsforum, gruppevenemang, meddelanden med mera. Du kan bes�ka  %link n�r du vill p� %s .

<br />

<br />

Tack.

<br />

<br />

<br />

------- <em><small>Detta �r en inbjudan.n</small></em> ------- <br />

<em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>

');



// Invitation PMS

define('GJ_HELLO_UDDEIM','Hej, %to_name. Du har bjudits in av %from_name till gruppen %group_name. Om du vill g� med i gruppen, var god g� till %link.');

define('GJ_HELLO_JIM','Hej, %to_name. Du har bjudits in av %from_name till gruppen %group_name. Om du vill g� med i gruppen, var god kopiera denna URL till din webbl�sares adressf�nster %link.');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','Vill du verkligen l�mna denna grupp?');

define('GJ_U_LEFT','<big><em>Du har nu l�mnat denna grupp.</em></big>');




// --------------------------

// GROUP MODERATOR

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below


// Group Moderator Navigation

define('GJ_INACTIVE_USERS','Inaktiva medlemmar');
define('GJ_EDIT_GROUP_INFO','Redigera gruppinformation');
define('GJ_MAIL_GROUP','Maila <em>alla i gruppen</em>');

define('GJ_TRANSFER_OWNER','�verf�r �garskap <em>till ny �gare</em>');

define('GJ_DELETE_GROUP','Radera <strike>denna grupp</strike>');

// Activate pending users (tmpl inactive)

define('GJ_INACTIVE_NAME','Medlemskap att godk�nna');

define('GJ_INACTIVE_STATUS','Aktiveringsstatus');

define('GJ_INACTIVE_ACTIONS','Gruppadmin �tg�rder');

define('GJ_MAKE_ACTIVE','Aktivera anv�ndare!');


// Email the Group
define('GJ_NO_INPUT','Input saknas');

define('GJ_MAIL_NO_SUBJECT','Ingen �renderad');

define('GJ_MAIL_NO_BODY','Meddelandet kan inte vara tomt');

define('GJ_MAIL_SUBJECT','�renderad');

define('GJ_MAIL_BODY','Meddelandetext');

define('GJ_MAIL_CC_MOD','Kryssa f�r denna f�r att skicka kopia till gruppadmin');




// Group Moderator Functions

define('GJ_MODER_FUNCTION','Administrat�rers uppgifter');

define('GJ_MODER_PROFILE','Administrat�rerns profil: ');

define('GJ_MODER_FUNC_BLANK','...denna meny �r tom<br /> om anv�ndaren inte �r en administrat�r');

define('GJ_NOT_MODER','OBS! Du �r inte admin f�r denna grupp.<br /> ...eller s� �r du inte inloggad?');



define('GJ_NEW_USERS_NEED_ACTIVATION','Nya anv�ndare grupper har g�tt med i din grupp, v�nligen aktivera dem.');

define('GJ_NOT_INACTIVE','Det finns inga inaktiva medlemmar.');


define('GJ_IS_ACT_NOW','Medlemmen �r nu aktiv.');
define('GJ_IS_INACT_NOW','Medlemmen �r nu inaktiv.');
define('GJ_MAKE_INACTIVE','Inaktivera');


define('GJ_GROUP_WAS_CREATED_APP','Gruppen har skapats. Var god v�nta p� administratorens godk�nnande.');


define('GJ_GROUP_INFO_WAS_EDITED','Gruppinformationen har redigerats');


define('GJ_TRANSFER_OWNER_HEADER','�verf�r gruppen till ny gruppadmin :');

define('GJ_TRANSFERRED','�garskapen f�r gruppen har �verf�rts!');

define('GJ_TRANS_TO_MBR_RQD','Ledsen, den nya gruppadmin m�ste vara medlem i gruppen.!');


define('GJ_DELETE_U_CONFIRM','V�nligen bekr�fta att du vill radera denna anv�ndare?');

define('GJ_USER_WAS_DELETED','Anv�ndaren raderades fr�n gruppen.');
define('GJ_DELETE_G_CONFIRM','V�nligen bekr�fta att du vill radera denna grupp?');

define('GJ_GROUP_WAS_DELETED','Gruppen har raderats!');

define('GJ_MES_WAS_EDITED','Meddelandet har redigerats.');

define('GJ_MES_WAS_DELETED','Meddelandet har raderats.');

define('GJ_MESSAGE_NOT_EXISTS','Meddelandet existerar inte.');


//ORPHAN?
define('GJ_GO_TO','Till min nya grupp');

//ORPHAN?

//ORPHAN?

define('GJ_GROUP_APPROVAL','Tack. Denna grupp kommer nu att ses �ver av sitens administrat�r f�r godk�nnande.');

//ORPHAN?

//ORPHAN?

define('GJ_GROUPNAME_EXISTS','En grupp med det namnet finns redan. Var v�nlig skapa den igen med ett nytt namn.');

//ORPHAN?


//ORPHAN?

define('GJ_STANDARD_FUNCTION','Standard funktioner');

//ORPHAN?

//ORPHAN?

define('GJ_U_G','En match mellan den anv�ndaren och den gruppen kunde inte hittas.');
//ORPHAN?



// --------------------------

// BULLETIN FUNCTIONS

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below


define('GJ_MOSTRECENT_BUL','(nyaste posterna)');
define('GJ_ARCHIVE','>> G� till det kompletta arkivet f�r');

define('GJ_ADD_POST_IN_BUL','L�gg till nytt meddelande i gruppens anslagstavla');

define('GJ_MESSAGE_WAS_ADDED','Meddelandet lades till gruppens anslagstavla');

define('GJ_EDIT','Redigera');




// Bulletin view

define('GJ_HTML_NOT_ALLOW','HTML �r inte till�tet');
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

define('GJ_NO_BULLETIN_AVAILABLE','Anslagstavlan �r inte tillg�nglig');





define('GJ_BULLETIN_LINKTEXT','Klicka h�r f�r att se alla anslag online, kommentera med mera...>');



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

- - - - <em><small>slut p� anslag</small></em> - - - - <br />

&nbsp;<br />

&nbsp;<br />

&nbsp;<br />

L�nk till Anslagstavla: <br />

<big>%link </big><br />

<br />

<em><small>* Detta meddelande skapades och skickades automatiskt.</small></em>');











// --------------------------

// EVENT FUNCTIONS

// --------------------------

define('GJ_LATEST_EVENTS','Senaste evenemang');

define('GJ_NO_EVENTS','<em>Det finns inga evenemang �nnu.</em>');

define('GJ_EVENTS_ONLY_FOR_MEMBERS','Evenemang �r endast f�r medlemmar.');



// --------------------------

// FORUM FUNCTIONS

// --------------------------



define('GJ_NO_FORUM_POSTS','<em>Det finns inga forummeddealanden �nnu.</em>');





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

define('GJ_NO_CAT_AVAILABLE','Inga publicerade kategorier finns - skapa minst en f�rst.');





define('GJ_NO_GROUPNAME','Gruppnamn �r tomt');

define('GJ_GR_WAS_ACTIVED','Grupp aktiverad');

define('GJ_GR_WAS_DEACTIVED','Grupp har bannats');

define('GJ_GR_WAS_DEL','Grupp har raderats.');

define('GJ_GR_N_EX','Grupp finns inte');



define('GJ_ACTIVITY','Gruppaktivitet');

define('GJ_INVITED','Gruppinbjudan');



define('GJ_NO_ADMIN','Ingen gruppadmin har tilldelats');

define('GJ_FILL_ALL','V�nligen fyll i alla f�lt');



define('GJ_SET_UPD','Inst�llningar uppdaterade');



// ORPHAN?

define('GJ_INT_T','V�rden i f�lt b�r vara heltal');

// ORPHAN?



// Admin email notification

//TRANSLATORS - PLEASE NOTE THE USE OF QUOTES "" AND THE \n TO CREATE LINE BREAKS IN THIS EMAIL ONLY. THANK YOU

define('GJ_NEWGROUPCREATED','"Hejsan gruppadmin \n

\n

En ny grupp har skapats.!\n

V�nligen bes�k webbsiten f�r att se den nya  gruppen och ta itu med administrativa uppgifter som kr�vs.\n

Tack.

\n

\n

------- slut p� admin meddelande ------- \n

Detta meddelande skapades och skickades automatiskt."');







//------------------------------

//   MODULE LANGUAGE STRINGS

//------------------------------

define('GJ_MODULE_NO_GROUPS','Du �r inte medlem av n�gon grupp.');

define('GJ_MODULE_MEMBERS','Medlemmar');

define('GJ_MODULE_MEMBER','Medlem');



define('GJ_ERROR_STATUS_ALREADY_SET','Status redan inst�lld!');

define('GJ_INVITE_LINKTEXT',' aktiveringssidan');



?> 