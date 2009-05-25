<?php



// --------------------------

// GLOBAL - global strings are used throughout GroupJive

// --------------------------



define('GJ_CREATEGROUP','<strong>Crie o seu pr�prio grupo!</strong>');

define('GJ_BACK','<~Para tr�s');

define('GJ_MEMBERS','Membros do grupo');

define('GJ_CURRENT_USER','Membros');

define('GJ_MEMBER','Membro');

define('GJ_USERNAME','Nome de utilizador');

define('GJ_REGISTERED','Presen�a Online');

define('GJ_USERONLINE','ONLINE');

define('GJ_USEROFFLINE','OFFLINE');



define('GJ_GROUPNAME','Nome do grupo');

define('GJ_GROUPDESCR','Sobre o grupo');

define('GJ_CATEGORY_GR','Categoria do grupo');

define('GJ_TYPE','Tipo de grupo');

define('GJ_LOGO','Logo do grupo');



define('GJ_DELETE','Apagar');



define('GJ_OPEN','Aberto para todos');

define('GJ_APREQUIRED','Necessita de aprova��o');

define('GJ_PRIVATE','Convidado para entrar');



define('GJ_SUBMIT','Submeta');

define('GJ_REQ','Obrigat�rio');

define('GJ_TITLE','Utilizadores do grupo');

define('GJ_SHOWALL','Mostre todos os grupos');

define('GJ_PAGE','Paginas');

define('GJ_BACK_MAIN_PAGE','Retorne � p�gina principal dos grupos');





// Show Overview (showoverview)

define('GJ_GROUP_CATEGORY','Categorias dos grupos da comunidade');



// Show Category (showcat)

define('GJ_SIMPLE_WELCOME','Bem vindo aos grupos');

define('GJ_SIMPLE_DESCR','Poder� visitar os grupos e mesmo criar um.');

define('GJ_CUR_GROUPS','Pessoas do grupo online');

define('GJ_YOU_ARE_ADMIN','Vo�� � o administrador destes grupo!');

define('GJ_ALREADY_MEMBER','Vo�� � membro deste grupo!');



define('GJ_CREATED','Criado');



// Search

define('GJ_SEARCH_GROUP','Procure grupo...');

define('GJ_SEARCH','Procura');

define('GJ_SEARCH_RESULTS','Aqui est�o os resultados');

define('GJ_NO_RESULTS','N�o foram encontrados grupos com esse nome');



// Group creation responses

define('GJ_GROUP_WAS_CREATED','O grupo foi criado com sucesso.');



define('GJ_CAT_HASNT_G','Sem grupos! Por favor crie o grupo ou contacte o administrador do site para publicar o grupo <br />.');





// --------------------------

// GENERAL WARNING AND ERROR MESSAGES

// --------------------------

define('GJ_PLEASE_LOGIN', 'Necessita de efectuar o login,ou registe-se.');

define('GJ_NO_GROUPS','N�o h� grupos visiveis. Necessita de fazer o login, criar ou aderir a algum grupo.');

define('GJ_NOTAUTH','ol�. Vo�� efectuou o login?<br />Por favor efectue o login depois confirma a entrada no grupo.');

define('GJ_ONLY_CURRENT','Erro! S� membros registados que efectuaram o login poder�o aceder a esta area .');



define('GJ_NO_CAT','Categorias ainda n�o foram criadas ! Please add using administrator module.');

define('GJ_GROUP_NOT_EXISTS','Erro! That group does not exist! Maybe it is not active yet?');



define('GJ_NO_USERS_FOUND', 'Sem utilizadores');

define('GJ_NOT_VALID_EMAIL','N�o � um email v�lido');

define('GJ_FILL_REQ','Erro! Por favor preencha todos os campos.');



define('GJ_PAGE_NOT_EX','a pagina n�o existe');





// --------------------------

// GROUP PAGES

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below



define('GJ_FOUNDED','Encontrado');

define('GJ_CREATOR','Administrador do grupo');



define ('GJ_NEWESTMEM', 'Membro Novo');



define ('GJ_LATESTBULLETIN', '�ltima novidade');



define ('GJ_LATESTFORUM', '�ltimo coment�rio');

define('GJ_DATE','Data');





// Group Function Navigation

define('GJ_GROUP_FUNCTIONS','Actividades de Grupo');

define('GJ_GROUP_BUL','Novidades do Grupo');

define('GJ_GROUP_EVENT','Eventos do Grupo ~>');

define('GJ_GROUP_FORUM','Forum do Grupo ~>');

define ('GJ_BACKTGROUP', '<~ Retornar ao Grupo');





// Join, Invite and Unjoin Groups

define('GJ_SIGN','Adira a este grupo');

define('GJ_INVITE','Convide pessoas (+)');

define('GJ_LEAVE_GROUP','Desista do grupo (-)');





//Open to join

define('GJ_WELCOME','Bem vindo,a sua entrada no grupo foi um sucesso!');





// Email Confirmation from *Open to join* Groups

define('GJ_NEW_MEMBER','Bem vindo(a),<br />

<br />

<br />

Este email � uma confirma��o de que<em>%to_name</em> aderiu ao grupo <strong>%group_name</strong>.<br/>

<br/>

<br/>Bem vindo ao grupo.<br/>

<br/>

<br/>

------- <em><small>end invitation</small></em> ------- <br />

<em><small>Est� mensagem foi automaticamente gerada.</small></em>

');





//Approval to join

define('GJ_YOU_ARE_SIGN_ALREADY','J� � membro do grupo! Talvez a sua conta ainda n�o foi activada? Contacte o dono do grupo');



define('GJ_WELCOME2','Obrigado... o dono do grupo devera aprovar <em>(and enable your login)</em>. Sua proposta foi enviada.');

define('GJ_PENDING','Sua proposta encontra-se pendente.');



define('GJ_INVITE_ONLY','Membro s� por convite');





// Invite to join

define('GJ_FR_NAME','Contacte por nome (S� para membros!)');

define('GJ_FR_EMAIL','Ou convide por email(Para n�o membros)');



define('GJ_USER_NOT_EXISTS','Erro!O utilizador n�o existe.');

define('GJ_USER_IN_GROUP','Erro! O utilizador j� � membro do grupo (Ou j� foram convidados, ou a conta destes n�o foi ainda activada).');



define('GJ_INVITE_WAS_SENT','Mensagem de convite enviada!');

define('GJ_YOU_WAS_INVITED','Est�s convidado(a)');



define('GJ_INVITE_NOT_EXIST','Erro! Esse convite n�o existe. <br />

Por favor confirme se efectuou o login.');





// Invitation Email to member

define('GJ_HELLO','Ol� %to_name,<br />

<br />

<br />

Recebeu um convite<em>invitation</em> de <em>%from_name</em> para aderir ao grupo <strong>%group_name</strong>.<br/>

<br/>

<br/> Para aderir, <big>por favor v� a %link.</big><br/>

<br/>

<br/>

------- <em><small>end invitation</small></em> ------- <br />

<em><small>Esta mensagem foi automaticamente gerada.</small></em>

');





// Invitation Email to non-member

define('GJ_INVITE_NONMEMBER','Ol�.<br />

<br />

<br />

Foi convidado por <em>%from_name</em> para <strong>%group_name</strong> neste site %s .

<br/>

<br/> Para ver este grupo, <big>por favor clique no link: %link</big>.<br/>

<br/>

<br/>

------- <em><small>end invitation</small></em> ------- <br />

<em><small>Esta mensagem foi automaticamente gerada.</small></em>

');





// Invitation PMS

define('GJ_HELLO_UDDEIM','Ol�, %to_name, Foi convidado por %from_name em %group_name. para aderir a este grupo, por favor v� a %link.');

define('GJ_HELLO_JIM','Ol�, %to_name. Foi convidado por %from_name em %group_name. Se quizer aderir ao grupo,por favor copie o endere�o e introduza no seu browser.

 %link');





// Responses to Unjoin request

define('GJ_DELETE_SELF_CONFIRM','Tem a certeza que quer desistir deste grupo?');

define('GJ_U_LEFT','<big><em>Desistiu do grupo com sucesso</em></big>');







// --------------------------

// GROUP MODERATOR

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below



// Group Moderator Navigation

define('GJ_INACTIVE_USERS','ACTIVE <em>Utilizadores pendentes</em>');

define('GJ_EDIT_GROUP_INFO','EDITE <em>Ferramentas de grupo</em>');

define('GJ_MAIL_GROUP', 'EMAIL <em>Todos do grupo</em>');

define('GJ_TRANSFER_OWNER', 'TRANSFIRA <em>para um novo dono</em>');

define('GJ_DELETE_GROUP','APAGUE <strike>este grupo</strike>');



// Activate pending users (tmpl inactive)

define('GJ_INACTIVE_NAME','Utilizadore(s)Pendentes');

define('GJ_INACTIVE_STATUS','Estado da activa��o');

define('GJ_INACTIVE_ACTIONS','Ac��es de modera��o');



define('GJ_MAKE_ACTIVE','Active o utilizador!');



// Email the Group

define('GJ_MAILS_WERE_SENT','Email foi enviado a todos os membros com sucesso.');

define('GJ_NO_INPUT', 'Sem introdu��o');

define('GJ_MAIL_NO_SUBJECT','Sem Assunto');

define('GJ_MAIL_NO_BODY', 'Messagem n�o pode ir vazia');

define('GJ_MAIL_SUBJECT','Assunto');

define('GJ_MAIL_BODY','Corpo da mensagem');

define('GJ_MAIL_CC_MOD','Clique aqui para enviar uma copia ao moderador');





// Group Moderator Functions

define('GJ_MODER_FUNCTION','Managers Tasks');

define('GJ_NOT_MODER','Erro! Voc� n�o � moderador deste grupo.<br /> ...ou ent�o n�o efectuou o login?');





define('GJ_NEW_USERS_NEED_ACTIVATION','Novos utilizadores juntaram-se a este grupo - Active-os.');



define('GJ_NOT_INACTIVE','N�o h� membros inactivos.');



define('GJ_IS_ACT_NOW','Membro activado.');

define('GJ_IS_INACT_NOW','Membro inactivo.');

define('GJ_MAKE_INACTIVE','Fa�a inactivo');



define('GJ_GROUP_WAS_CREATED_APP','O grupo foi criado com sucesso,pendente para revis�o do administrador.');



define('GJ_GROUP_INFO_WAS_EDITED','Os detalhes do grupo foi editados com sucesso!');



define('GJ_TRANSFERRED','O seu grupo foi transferido para outro!');

define('GJ_TRANS_TO_MBR_RQD','Desculpe, mas esse membro poder� j� fazer parte do grupo!');



define('GJ_DELETE_U_CONFIRM','Por favor confirme, deseja apagar utilizador?');

define('GJ_USER_WAS_DELETED','Utilizador foi eliminado do seu grupo com sucesso!');

define('GJ_DELETE_G_CONFIRM','Por favor confirme a elimina��o deste grupo?');

define('GJ_GROUP_WAS_DELETED','O grupo foi eliminado com sucesso!');



define('GJ_MES_WAS_EDITED','Mensagem editada com sucesso.');

define('GJ_MES_WAS_DELETED','A mensagem foi apagada.');

define('GJ_MESSAGE_NOT_EXISTS','Erro! A mensagem n�o existe!');





//ORPHAN?

define('GJ_GO_TO','Leve-me ao meu grupo novo!');

//ORPHAN?



//ORPHAN?

define('GJ_GROUP_APPROVAL','Obrigado. O grupo ir� ser revisto pelo administrador do site.');

//ORPHAN?



//ORPHAN?

define('GJ_GROUPNAME_EXISTS','J� existe um grupo com esse nome! Por favor crie outro com outro nome.');

//ORPHAN?



//ORPHAN?

define('GJ_STANDARD_FUNCTION','Fun��es Standard');

//ORPHAN?



//ORPHAN?

define('GJ_U_G','Match with that user and group was not found.');

//ORPHAN?





// --------------------------

// BULLETIN FUNCTIONS

// --------------------------

// note: look top of page in GLOBAL for additional strings not shown below



define('GJ_ARCHIVE','Mostre todas as novidades');

define('GJ_ADD_POST_IN_BUL','Adicione um comentario nas novidades do grupo');

define('GJ_MESSAGE_WAS_ADDED','A sua mensagem foi adicionada �s novidades ');

define('GJ_EDIT','Edite Novidades');





// Bulletin view

define('GJ_HTML_NOT_ALLOW','<em>HTML n�o � permitido</em>');

define('GJ_AUTHOR','Autor');

define('GJ_SUBJECT','Titulo da novidade');

define('GJ_LEAVE_MESSAGE','Escreva a sua novidade');

define('GJ_BY','por');

define('GJ_POST','Coment�rio');

define('GJ_MESSAGE','Messagem');



define('GJ_NO_MESSAGE','<em>N�o existe novidades</em>');

define('GJ_ONLY_MEMBERS_CAN_POST', 'S� membros do grupo podem adicionar novidades.');

define('GJ_MES_COULD_NOT_DELETED', 'N�o pode apagar essa novidade!');

define('GJ_NO_BULLETIN_AVAILABLE','Novidade indisponivel.');


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
// Bulletin Email

define('GJ_NEW_BUL','Ol�, <br />

<br />

<strong>%s</strong> P�s uma novidade no grupo <big><em>%s</em></big>. <br />

<br />

<br />

= = =  BULLETIN = = = <br />



<br />

%s <br />

------- <em><small>end bulletin</small></em> ------- <br />

<br />

<br />

Link: %s<br />



<em><small>Esta mensagem foi automaticamente gerada.</small></em>');
**/







// --------------------------

// EVENT FUNCTIONS

// --------------------------





// --------------------------

// FORUM FUNCTIONS

// --------------------------



define('GJ_NO_FORUM_POSTS','<em>Ainda n�o existem coment�rios.</em>');







// --------------------------

// ADMINISTRATOR

// --------------------------



define('GJ_GR_CUR_CAT','Categorias currentes');

define('GJ_ADD','Adicione categoria');

define('GJ_CAT_WAS_W','Categoria foi Adicionada');

define('GJ_CAT_WAS_EDITED','Category was Edited');

define('GJ_WAS_DELETED','Categoria foi apagada');

define('GJ_CAT_NOT_EX','Categoria n�o existe');

define('GJ_CAT_AL_EXF','J� existe categoria com esse nome');



define('GJ_NO_CAT_SELECTED', 'N�o h� categorias seleccionadas');

define('GJ_NO_CAT_AVAILABLE', 'Sem categorias publicadas - crie pelo menos uma.');





define('GJ_NO_GROUPNAME', 'o nome do grupo est� vazio');

define('GJ_GR_WAS_ACTIVED','Grupo(s) activo(s)');

define('GJ_GR_WAS_DEACTIVED','Grupo(s) banido(s)');

define('GJ_GR_WAS_DEL','Grupo(s) eliminado(s)!');

define('GJ_GR_N_EX','Grupo n�o existe');



define('GJ_ACTIVITY','Actividade do grupo');

define('GJ_INVITED','Convite do grupo');



define('GJ_NO_ADMIN','Sem Administrador');

define('GJ_FILL_ALL','Preencha todos os campos');



define('GJ_SET_UPD','Settings Updated');



// ORPHAN?

define('GJ_INT_T','Values of fields groups on page, messages on frontpage should be integer');

// ORPHAN?



// Admin email notification

define('GJ_NEWGROUPCREATED','Ol� administrador de groupo<br />

<br />

<br />

Um novo grupo foi criado no site!<br/>

<br/>

<br/> 

Por favor visite o site para mais...<br/>

<br/>

<br/>

Obrigado.

<br/>

<br/>

------- <em><small>end admin notification</small></em> ------- <br />

<em><small>Esta mensagem foi gerada automaticamente.</small></em>

');





//------------------------------

//   MODULE LANGUAGE STRINGS

//------------------------------

define('GJ_MODULE_NO_GROUPS','N�o � membro deste grupo.');



?>

