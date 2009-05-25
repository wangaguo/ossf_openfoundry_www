<?php
// *******************************************************************
// Title          udde Instant Messages (uddeIM)
// Description    Instant Messages System for Mambo 4.5 / Joomla 1.0 / Joomla 1.5
// Author         � 2007-2008 Stephan Slabihoud, � 2006 Benjamin Zweifel
// License        This is free software and you may redistribute it under the GPL.
//                uddeIM comes with absolutely no warranty.
//                Use at your own risk. For details, see the license at
//                http://www.gnu.org/licenses/gpl.txt
//                Other licenses can be found in LICENSES folder.
// *******************************************************************
// Language file: Brazilian Portuguese (Latin-1)
// Translator:    Ed Blender <edublender@gmail.com>
// *******************************************************************

// New: 1.5
DEFINE ('_UDDEMODULE_ALLDAYS', ' mensagens');
DEFINE ('_UDDEMODULE_7DAYS', ' mensagens nos �ltimos 7 dias');
DEFINE ('_UDDEMODULE_30DAYS', ' mensagens nos �ltimos 30 dias');
DEFINE ('_UDDEMODULE_365DAYS', ' mensagens nos �ltimos 365 dias');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_WARNING', '<br /><b>Nota:<br />Se estiver usando o mosMail, voc� tem que configurar com um endere�o de e-mail v�lido!</b>');
DEFINE ('_UDDEIM_FILTEREDMESSAGE', 'mensagem filtrada');
DEFINE ('_UDDEIM_FILTEREDMESSAGES', 'mensagens flitradas');
DEFINE ('_UDDEIM_FILTER', 'Filtro:');
DEFINE ('_UDDEIM_FILTER_TITLE_INBOX', 'Apenas deste usu�rio');
DEFINE ('_UDDEIM_FILTER_TITLE_OUTBOX', 'Apenas para este usu�rio');
DEFINE ('_UDDEIM_FILTER_UNREAD_ONLY', 'apenas n�o-lidas');
DEFINE ('_UDDEIM_FILTER_SUBMIT', 'Filtro');
DEFINE ('_UDDEIM_FILTER_ALL', '- tudo -');
DEFINE ('_UDDEIM_FILTER_PUBLIC', '- usu�rios p�blicos -');
DEFINE ('_UDDEADM_FILTER_HEAD', 'Ativar Filtro');
DEFINE ('_UDDEADM_FILTER_EXP', 'Se ativado, os usu�rios podem filtrar suas Caixas de Entrada / Sa�da para mostrar as mensagens de um remetente ou destinat�rio.');
DEFINE ('_UDDEADM_FILTER_P0', 'desativado');
DEFINE ('_UDDEADM_FILTER_P1', 'acima da lista de mensagens');
DEFINE ('_UDDEADM_FILTER_P2', 'abaixo da lista de mensagens');
DEFINE ('_UDDEADM_FILTER_P3', 'acima e abaixo da lista de mensagens');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED', '<b>Voc� n�o tem mensagens%s em%s.</b>');	// see next  six lines
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_UNREAD', ' n�o-lidas');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_FROM', ' deste usu�rio');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_TO', ' para este usu�rio');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_INBOX', ' sua Caixa de Entrada');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_OUBOX', ' sua Caixa de Sa�da');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_ARCHIVE', ' seu Arquivo');
DEFINE ('_UDDEIM_TODP_TITLE', 'Destinat�rio');
DEFINE ('_UDDEIM_TODP_TITLE_CC', 'Um ou mais destinat�rios (separados por v�rgula)');
DEFINE ('_UDDEIM_ADDCCINFO_TITLE', 'Quando marcada, uma linha contendo todos os destinat�rios ser� adicionada � mensagem.');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_2', '...define o padr�o para auto-resposta, auto-encaminhar, inputbox, filtro');
DEFINE ('_UDDEADM_AUTORESPONDER_HEAD', 'Ativar Auto-resposta');
DEFINE ('_UDDEADM_AUTORESPONDER_EXP', 'Quando a auto-resposta � ativada o usu�rio pode habilitar uma notifica��o de auto-resposta em suas configura��es pessoais.');
DEFINE ('_UDDEIM_EMN_AUTORESPONDER', 'Ativar Auto-resposta');
DEFINE ('_UDDEIM_AUTORESPONDER', 'Auto-resposta');
DEFINE ('_UDDEIM_AUTORESPONDER_EXP', 'Quanto a auto-resposta � ativada, cada mensagem recebida ser� imediatamente respondida.');
DEFINE ('_UDDEIM_AUTORESPONDER_DEFAULT', "Desculpe, no momento eu n�o estou dispon�vel.\nVou verificar minha caixa postal assim que poss�vel.");
DEFINE ('_UDDEADM_USERSET_AUTOR', 'Auto-R');
DEFINE ('_UDDEADM_USERSET_SELAUTOR', '- Auto-R -');
DEFINE ('_UDDEIM_USERBLOCKED', 'Usu�rio est� bloqueado.');
DEFINE ('_UDDEADM_AUTOFORWARD_HEAD', 'Ativar Auto-encaminhar');
DEFINE ('_UDDEADM_AUTOFORWARD_EXP', 'Quando o auto-encaminhar � ativado, o usu�rio pode encaminhar novas mensagens para outro usu�rio, automaticamente.');
DEFINE ('_UDDEIM_EMN_AUTOFORWARD', 'Ativar Auto-encaminhar');
DEFINE ('_UDDEADM_USERSET_AUTOF', 'Auto-E');
DEFINE ('_UDDEADM_USERSET_SELAUTOF', '- Auto-E -');
DEFINE ('_UDDEIM_AUTOFORWARD', 'Auto-encaminhar');
DEFINE ('_UDDEIM_AUTOFORWARD_EXP', 'Novas mensagems podem ser encaminhadas para outro usu�rio automaticamente.');
DEFINE ('_UDDEIM_THISISAFORWARD', 'Auto-encaminhamento de uma mensagem originalmente enviada para ');
DEFINE ('_UDDEADM_COLSROWS_HEAD', 'Caixa de Mensagem (colunas/linhas)');
DEFINE ('_UDDEADM_COLSROWS_EXP', 'Especifica as colunas e linhas da caixa de mensagem (valores padr�o s�o 60/10).');
DEFINE ('_UDDEADM_WIDTH_HEAD', 'Caixa de Mensagem (largura)');
DEFINE ('_UDDEADM_WIDTH_EXP', 'Especifica a largura da caixa de mensagem, em pixels (o padr�o � 0). Se o valor for 0, a largura especificada no arquivo de estilos CSS ser� usado.');
DEFINE ('_UDDEADM_CBE', 'CB Enhanced');

// New: 1.4
DEFINE ('_UDDEADM_IMPORT_CAPS', 'IMPORTAR');

// New: 1.3
DEFINE ('_UDDEADM_MOOTOOLS_HEAD', 'Carregar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_EXP', 'Especifica como o uddeIM carrega MooTools (MooTools � requerido pelo Autocompletar): <i>Nenhum</i> � �til quando seus temas carregam MooTools, <i>Auto</i> � recomendado por padr�o (da mesma forma que no uddeIM 1.2), quando usando J1.0 voc� pode tamb�m for�ar o carregamendo do MooTools 1.1 ou 1.2.');
DEFINE ('_UDDEADM_MOOTOOLS_NONE', 'n�o carregar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_AUTO', 'auto');
DEFINE ('_UDDEADM_MOOTOOLS_1', 'for�ar carregamendo do MooTools 1.1');
DEFINE ('_UDDEADM_MOOTOOLS_2', 'for�ar carregamento do MooTools 1.2');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_1', '...configura��o padr�o para o MooTools');
DEFINE ('_UDDEADM_AGORA', 'Agora');

// New: 1.2
DEFINE ('_UDDEADM_CRYPT3', 'Base64 encoded');
DEFINE ('_UDDEADM_TIMEZONE_HEAD', 'Ajustar fuso hor�rio');
DEFINE ('_UDDEADM_TIMEZONE_EXP', 'Quando o uddeIM mostra a hora com erro voc� pode ajustar o fuso hor�rio nesta configura��o. Normalmente, quando tudo est� configurado corretamente,  isto deveria estar com zero. Serve para casos em que voc� precise mudar este valor.');
DEFINE ('_UDDEADM_HOURS', 'horas');
DEFINE ('_UDDEADM_VERSIONCHECK', 'Informa��o de vers�o:');
DEFINE ('_UDDEADM_STATISTICS', 'Estat�sticas:');
DEFINE ('_UDDEADM_STATISTICS_HEAD', 'Mostrar estat�sticas');
DEFINE ('_UDDEADM_STATISTICS_EXP', 'Mostra algumas estat�sticas como o n�mero de mensagens armazenadas, etc.');
DEFINE ('_UDDEADM_STATISTICS_CHECK', 'MOSTRAR ESTAT�STICAS');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT', 'Mensagens armazenadas no banco de dados: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_RECIPIENT', 'Mensagens na Lixeira por destinat�rio: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_SENDER', 'Mensagens na Lixeira pelo remetente: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_TRASH', 'Mensagens em espera para exclus�o: ');
DEFINE ('_UDDEADM_OVERWRITEITEMID_HEAD', 'Sobrepor Itemid');
DEFINE ('_UDDEADM_OVERWRITEITEMID_EXP', 'Normalmente o uddeIM tenta detectar o Itemid correto quando o mesmo n�o foi definido. Em alguns casos pode ser necess�rio sobrepor este valor, por exemplo quando voc� utiliza v�rios links de menu para o uddeIM.');
DEFINE ('_UDDEADM_OVERWRITEITEMID_CURRENT', 'O Itemid Detectado �: ');
DEFINE ('_UDDEADM_USEITEMID_HEAD', 'Usar Itemid');
DEFINE ('_UDDEADM_USEITEMID_EXP', 'Use este Itemid ao inv�s do que foi detectado.');
DEFINE ('_UDDEADM_SHOWLINK_HEAD', 'Usar links de perfil');
DEFINE ('_UDDEADM_SHOWLINK_EXP', 'Quando definido com <i>sim</i>, os nomes de usu�rio exibidos no uddeIM aparecer�o como links para o perfil de usu�rio.');
DEFINE ('_UDDEADM_SHOWPIC_HEAD', 'Mostrar miniaturas');
DEFINE ('_UDDEADM_SHOWPIC_EXP', 'Quando definido com <i>sim</i>, a miniatura do respectivo usu�rio ser� exibida durante a leitura de uma mensagem.');
DEFINE ('_UDDEADM_THUMBLISTS_HEAD', 'Mostrar miniaturas em listas');
DEFINE ('_UDDEADM_THUMBLISTS_EXP', 'Definir com <i>sim</i> se voc� deseja mostrar miniaturas dos usu�rios durante a visualiza��o de listas de mensagens (entrada, sa�da, etc.)');
DEFINE ('_UDDEADM_FIREBOARD', 'Fireboard');
DEFINE ('_UDDEADM_CB', 'Community Builder');
DEFINE ('_UDDEADM_DISABLED', 'Desativado');
DEFINE ('_UDDEADM_ENABLED', 'Ativado');
DEFINE ('_UDDEIM_STATUS_FLAGGED', 'Importante');
DEFINE ('_UDDEIM_STATUS_UNFLAGGED', '');
DEFINE ('_UDDEADM_ALLOWFLAGGED_HEAD', 'Permitir marcador de mensagem');
DEFINE ('_UDDEADM_ALLOWFLAGGED_EXP', 'Permite marca��o de mensagens (o uddeIM mostra uma estrela em listas que podem ser destacadas para marcar mensagens importantes).');
DEFINE ('_UDDEADM_REVIEWUPDATE', 'Importante: Quando voc� atualizou o uddeIM de uma vers�o anterior, por favor leia o README. �s vezes voc� tem que adicionar ou modificar as tabelas ou campos do banco de dados !');
DEFINE ('_UDDEIM_ADDCCINFO', 'Adicionar linha CC:');
DEFINE ('_UDDEIM_CC', 'CC:');
DEFINE ('_UDDEADM_TRUNCATE_HEAD', 'Abreviar texto citado');
DEFINE ('_UDDEADM_TRUNCATE_EXP', 'Abrevia textos citados em 2/3 do comprimento m�ximo, caso o comprimento do texto excedida este limite.');
DEFINE ('_UDDEIM_PLUG_INBOXENTRIES', 'Mensagens na Caixa de Entrada ');
DEFINE ('_UDDEIM_PLUG_LAST', '�ltima ');
DEFINE ('_UDDEIM_PLUG_ENTRIES', ' mensagens');
DEFINE ('_UDDEIM_PLUG_STATUS', 'Status');
DEFINE ('_UDDEIM_PLUG_SENDER', 'Remetente');
DEFINE ('_UDDEIM_PLUG_MESSAGE', 'Mensagem');
DEFINE ('_UDDEIM_PLUG_EMPTYINBOX', 'Caixa de Entrada Vazia');

// New: 1.1
DEFINE ('_UDDEADM_NOTRASHACCESS_NOT', 'Acesso � lixeira n�o permitido.');
DEFINE ('_UDDEADM_NOTRASHACCESS_HEAD', 'Restringir acesso � lixeira');
DEFINE ('_UDDEADM_NOTRASHACCESS_EXP', 'Voc� pode restringir o acesso � lixeira. Normalmente a lixeira � dispon�vel � todos (<i>sem restri��o</i>). Voc� pode restringir o acesso � usu�rios especiais ou somente � administradores, de modo que grupos com direitos de acesso menor n�o possam restaurar uma mensagem.');
DEFINE ('_UDDEADM_NOTRASHACCESS_0', 'sem restri��o');
DEFINE ('_UDDEADM_NOTRASHACCESS_1', 'usu�rios especiais');
DEFINE ('_UDDEADM_NOTRASHACCESS_2', 'administradores');
DEFINE ('_UDDEADM_PUBHIDEUSERS_HEAD', 'Ocultar usu�rios da lista de usu�rios');
DEFINE ('_UDDEADM_PUBHIDEUSERS_EXP', 'Informe as IDs de usu�rios que deseja ocultar da lista p�blica de usu�rios (ex.: 65,66,67).');
DEFINE ('_UDDEADM_HIDEUSERS_HEAD', 'Ocultar usu�rios da lista de usu�rios');
DEFINE ('_UDDEADM_HIDEUSERS_EXP', 'Informe as IDs de usu�rios que deseja ocultar da lista de usu�rios (ex.: 65,66,67). Admins sempre v�em a lista completa.');
DEFINE ('_UDDEIM_ERRORCSRF', 'Ataque CSRF reconhecido');
DEFINE ('_UDDEADM_CSRFPROTECTION_HEAD', 'Prote��o CSRF');
DEFINE ('_UDDEADM_CSRFPROTECTION_EXP', 'Isto protege todos os formul�rios de ataques Cross-Site Request Forgery. Isto deve permanecer ativado. Voc� s� tem que desligar isto apenas caso ocorram problemas em seu site.');
DEFINE ('_UDDEIM_CANTREPLYARCHIVE', 'Voc� n�o pode responder � mensagens arquivadas.');
DEFINE ('_UDDEIM_COULDNOTRECALLPUBLIC', 'Respostas � usu�rios n�o registradros n�o podem ser executadas.');
DEFINE ('_UDDEADM_PUBREPLYS_HEAD', 'Permitir respostas');
DEFINE ('_UDDEADM_PUBREPLYS_EXP', 'Permitir respostas diretas � mensagens de usu�rios p�blicos.');
DEFINE ('_UDDEIM_EMN_BODY_PUBLICWITHMESSAGE',
"Ol� %user%,\n\n%you% te enviou a seguinte mensagem privada no %site%.\n__________________\n%pmessage%");
DEFINE ('_UDDEADM_PUBNAMESTEXT', 'Mostrar nomes verdadeiros');
DEFINE ('_UDDEADM_PUBNAMESDESC', 'Mostra nomes verdadeiros ou nomes de usu�rio no site p�blico?');
DEFINE ('_UDDEIM_USERLIST', 'Lista de Usu�rio');
DEFINE ('_UDDEIM_YOUHAVETOWAIT', 'Desculpe, voc� tem que aguardar um pouco antes de poder enviar uma nova mensagem');
DEFINE ('_UDDEADM_USERSET_LASTSENT', '�ltima enviada');
DEFINE ('_UDDEADM_TIMEDELAY_HEAD', 'Intervalo de Espera');
DEFINE ('_UDDEADM_TIMEDELAY_EXP', 'Intervalo de tempo, em segundos, que o usu�rio deve aguardar entre o envio de novas mensagens (0 para nenhum intervalo).');
DEFINE ('_UDDEADM_SECONDS', 'segundos');
DEFINE ('_UDDEIM_PUBLICSENT', 'Mensagem enviada.');
DEFINE ('_UDDEIM_ERRORINFROMNAME', 'Erro no nome do remetente');
DEFINE ('_UDDEIM_ERRORINEMAIL', 'Erro no endere�o de e-mail');
DEFINE ('_UDDEIM_YOURNAME', 'Seu nome:');
DEFINE ('_UDDEIM_YOUREMAIL', 'Seu e-mail:');
DEFINE ('_UDDEADM_VERSIONCHECK_USING', 'Voc� est� usando o uddeIM ');
DEFINE ('_UDDEADM_VERSIONCHECK_LATEST', 'Voc� j� est� usando a vers�o mais recente do uddeIM.');
DEFINE ('_UDDEADM_VERSIONCHECK_CURRENT', 'A vers�o atual � ');
DEFINE ('_UDDEADM_VERSIONCHECK_INFO', 'Informa��o de atualiza��o:');
DEFINE ('_UDDEADM_VERSIONCHECK_HEAD', 'Verificar atualiza��es');
DEFINE ('_UDDEADM_VERSIONCHECK_EXP', 'Isto contata o site do desenvolvedor para obter informa��es sobre a vers�o atual do uddeIM. Exceto pela vers�o do uddeIM que voc� est� usando, nenhuma outra informa��o ser� transmitida.');
DEFINE ('_UDDEADM_VERSIONCHECK_CHECK', 'VERIFICAR AGORA');
DEFINE ('_UDDEADM_VERSIONCHECK_ERROR', 'N�o foi poss�vel receber a informa��o de vers�o.');
DEFINE ('_UDDEIM_NOSUCHLIST', 'Lista de Contatos n�o encontrada!');
DEFINE ('_UDDEIM_LISTSLIMIT_1', 'O n�mero de destinat�rios excedeu o limite m�ximo permitido. ');
DEFINE ('_UDDEADM_MAXONLISTS_HEAD', 'M�x. de mensagens');
DEFINE ('_UDDEADM_MAXONLISTS_EXP', 'M�x. de mensagens permitidas por lista de contatos.');
DEFINE ('_UDDEIM_LISTSNOTENABLED', 'Lista de Contatos n�o foram ativadas');
DEFINE ('_UDDEADM_ENABLELISTS_HEAD', 'Ativar listas de contatos');
DEFINE ('_UDDEADM_ENABLELISTS_EXP', 'O uddeIM permite que usu�rios criem listas de contatos. Tais listas podem ser usadas para enviar mensagens � m�ltiplos usu�rios. N�o esque�a de ativar m�ltiplos destinat�rios quando voc� desejar usar as listas de contatos.');
DEFINE ('_UDDEADM_ENABLELISTS_0', 'desativado');
DEFINE ('_UDDEADM_ENABLELISTS_1', 'usu�rios registrados');
DEFINE ('_UDDEADM_ENABLELISTS_2', 'usu�rios especiais');
DEFINE ('_UDDEADM_ENABLELISTS_3', 's� administradores');
DEFINE ('_UDDEIM_LISTSNEW', 'Criar nova lista de contatos');
DEFINE ('_UDDEIM_LISTSSAVED', 'Lista de contatos foi salva');
DEFINE ('_UDDEIM_LISTSUPDATED', 'Lista de contato foi atualizada');
DEFINE ('_UDDEIM_LISTSDESC', 'Descri��o');
DEFINE ('_UDDEIM_LISTSNAME', 'Nome');
DEFINE ('_UDDEIM_LISTSNAMEWO', 'Nome (sem espa�os em branco)');
DEFINE ('_UDDEIM_EDITLINK', 'editar');
DEFINE ('_UDDEIM_LISTS', 'Contatos');
DEFINE ('_UDDEIM_STATUS_READ', 'lida');
DEFINE ('_UDDEIM_STATUS_UNREAD', 'n�o lida');
DEFINE ('_UDDEIM_STATUS_ONLINE', 'online');
DEFINE ('_UDDEIM_STATUS_OFFLINE', 'offline');
DEFINE ('_UDDEADM_CBGALLERY_HEAD', 'Exibir figuras da Galeria do CB');
DEFINE ('_UDDEADM_CBGALLERY_EXP', 'Por padr�o, o uddeIM s� exibe avatares de usu�rios que fizeram upload de avatar. Quando voc� ativa esta op��o, o uddeIM tamb�m passa a exibir figuras da galeria de avatares do Community Builder.');
DEFINE ('_UDDEADM_UNBLOCKCB_HEAD', 'Desbloquear Conex�es CB');
DEFINE ('_UDDEADM_UNBLOCKCB_EXP', 'Voc� pode permitir que mensagens � destinat�rios quando o remetente � um usu�rio que est� na lista de conex�es do Community Builder (mesmo que o destinat�rio esteja num grupo bloqueado). Esta op��o � independente do bloqueio individual, que quando ativado, os usu�rios podem configurar (veja acima).');
DEFINE ('_UDDEIM_GROUPBLOCKED', 'Voc� n�o tem permiss�o para enviar para este grupo.');
DEFINE ('_UDDEIM_ONEUSERBLOCKS', 'O destinat�rio bloqueou voc�.');
DEFINE ('_UDDEADM_BLOCKGROUPS_HEAD', 'Grupos bloqueados (usu�rios registrados)');
DEFINE ('_UDDEADM_BLOCKGROUPS_EXP', 'Grupos aos quais usu�rios registrados n�o tem permiss�o para enviar mensagens. Isto � apenas para usu�rios registrados. Usu�rios especiais e administradores n�o s�o afetados por esta configura��o. Esta op��o � independente do bloqueio individual, que quando ativado, os usu�rios podem configurar (veja acima).');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_HEAD', 'Grupos bloqueados (usu�rios p�blicos)');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_EXP', 'Grupos aos quais usu�rios p�blicos n�o tem permiss�o para enviar mensagens. Esta op��o � independente do bloqueio individual, que quando ativado, os usu�rios podem configurar (veja acima). Quando voc� bloqueia um grupo, usu�rios desse grupo n�o podem ver a op��o para ativar a exibi��o p�blica nas configura��es de seus perfis.');
DEFINE ('_UDDEADM_BLOCKGROUPS_1', 'Usu�rio P�blico');
DEFINE ('_UDDEADM_BLOCKGROUPS_2', 'Conex�o CB');
DEFINE ('_UDDEADM_BLOCKGROUPS_18', 'Usu�rio Registrado');
DEFINE ('_UDDEADM_BLOCKGROUPS_19', 'Autor');
DEFINE ('_UDDEADM_BLOCKGROUPS_20', 'Editor');
DEFINE ('_UDDEADM_BLOCKGROUPS_21', 'Publicador');
DEFINE ('_UDDEADM_BLOCKGROUPS_23', 'Gerenciador');
DEFINE ('_UDDEADM_BLOCKGROUPS_24', 'Administrador');
DEFINE ('_UDDEADM_BLOCKGROUPS_25', 'Super Administrador');
DEFINE ('_UDDEIM_NOPUBLICMSG', 'Usu�rio s� aceita mensagens de usu�rios registrados.');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_HEAD', 'Ocultar da lista p�blica "Todos os Usu�rios"');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_EXP', 'Voc� pode ocultar certos grupos para que n�o apare�am na lista p�blica "Todos os Usu�rios". Nota: isto oculta s� os nomes, os usu�rios podem continuar recebendo mensagens. Usu�rios que n�o ativaram a exibi��o p�blica nunca aparecer�o listados nesta lista.');
DEFINE ('_UDDEADM_HIDEALLUSERS_HEAD', 'Ocultar da lista "Todos os Usu�rios"');
DEFINE ('_UDDEADM_HIDEALLUSERS_EXP', 'Voc� pode ocultar certos grupos para que n�o apare�am na lista p�blica "Todos os Usu�rios". Nota: isto oculta s� os nomes, os usu�rios podem continuar recebendo mensagens.');
DEFINE ('_UDDEADM_HIDEALLUSERS_0', 'nenhum');
DEFINE ('_UDDEADM_HIDEALLUSERS_1', 'apenas super administradores');
DEFINE ('_UDDEADM_HIDEALLUSERS_2', 'apenas administradores');
DEFINE ('_UDDEADM_HIDEALLUSERS_3', 'usu�rios especiais');
DEFINE ('_UDDEADM_PUBLIC', 'P�blico');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_HEAD', 'Comportamento do link "Todos os Usu�rios"');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_EXP', 'Escolha se o link "Todos os Usu�rios" deve ser omitido do p�blico, ou se sempre ser� mostrado � todos os usu�rios.');
DEFINE ('_UDDEADM_USERSET_PUBLIC', 'Site P�blico');
DEFINE ('_UDDEADM_USERSET_SELPUBLIC', '- selecionar p�blico -');
DEFINE ('_UDDEIM_OPTIONS_F', 'Permitir usu�rios p�blicos enviarem mensagem');
DEFINE ('_UDDEIM_MSGLIMITREACHED', 'Foi atingido o limite de mensagens!');
DEFINE ('_UDDEIM_PUBLICUSER', 'Usu�rio p�blico');
DEFINE ('_UDDEIM_DELETEDUSER', 'Usu�rio deletado');
DEFINE ('_UDDEADM_CAPTCHALEN_HEAD', 'Tamanho do Captcha');
DEFINE ('_UDDEADM_CAPTCHALEN_EXP', 'Especifica quandos caracteres um usu�rio deve digitar.');
DEFINE ('_UDDEADM_USECAPTCHA_HEAD', 'Prote��o Captcha de spam');
DEFINE ('_UDDEADM_USECAPTCHA_EXP', 'Especifica quem ser� verificado pelo captcha quando enviando mensagens');
DEFINE ('_UDDEADM_CAPTCHAF0', 'desativado');
DEFINE ('_UDDEADM_CAPTCHAF1', 'apenas usu�rios p�blicos');
DEFINE ('_UDDEADM_CAPTCHAF2', 'usu�rios p�blicos e registrados');
DEFINE ('_UDDEADM_CAPTCHAF3', 'usu�rios p�blicos, registrados e especiais');
DEFINE ('_UDDEADM_CAPTCHAF4', 'todos os usu�rios (inclusive admins)');
DEFINE ('_UDDEADM_PUBFRONTEND_HEAD', 'Ativar exibi��o no site');
DEFINE ('_UDDEADM_PUBFRONTEND_EXP', 'Quando ativado, usu�rios p�blicos podem enviar mensagens aos usu�rios registrados (que podem especificar em suas configura��es pessoais se desejam usar este recursos).');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_HEAD', 'Padr�o de exibi��o p�blica');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_EXP', 'Este � o valor padr�o que determina se um usu�rio p�blico pode enviar mensagens aos usu�rios registrados.');
DEFINE ('_UDDEADM_PUBDEF0', 'desativado');
DEFINE ('_UDDEADM_PUBDEF1', 'ativado');
DEFINE ('_UDDEIM_WRONGCAPTCHA', 'C�digo de seguran�a incorreto');

// New: 1.0
DEFINE ('_UDDEADM_NONEORUNKNOWN', 'nenhum ou desconhecido');
DEFINE ('_UDDEADM_DONATE', 'Se voc� gosta do uddeIM e quer contribuir com o desenvolvedor, por favor fa�a uma pequena doa��o.');
// New: 1.0rc2
DEFINE ('_UDDEADM_BACKUPRESTORE_DATE', 'Configura��o encontrada no banco de dados: ');
DEFINE ('_UDDEADM_BACKUPRESTORE_HEAD', 'Backup e Restau��o de Configura��o');
DEFINE ('_UDDEADM_BACKUPRESTORE_EXP', 'Voc� pode fazer o backup da sua configura��o para o banco de dados e restaur�-la quando necess�rio. Isto � �til quando voc� atualiza o uddeIM ou quando voc� quer salvar uma certa configura��o, para fins de testes.');
DEFINE ('_UDDEADM_BACKUPRESTORE_BACKUP', 'BACKUP');
DEFINE ('_UDDEADM_BACKUPRESTORE_RESTORE', 'RESTAURAR');
DEFINE ('_UDDEADM_CANCEL', 'Cancelar');
// New: 1.0rc1
DEFINE ('_UDDEADM_LANGUAGECHARSET_HEAD', 'Conjunto de caracteres do arquivo de Idioma');
DEFINE ('_UDDEADM_LANGUAGECHARSET_EXP', 'Normalmente, <strong>padr�o</strong> (ISO-8859-1) � para o Joomla 1.0, e <strong>UTF-8</strong> para o Joomla 1.5.');
DEFINE ('_UDDEADM_LANGUAGECHARSET_UTF8', 'UTF-8');
DEFINE ('_UDDEADM_LANGUAGECHARSET_DEFAULT', 'padr�o');
DEFINE ('_UDDEIM_READ_INFO_1', 'Mensagens lidas ficar�o na Caixa de Entrada por ');
DEFINE ('_UDDEIM_READ_INFO_2', ' dias no m�x. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEIM_UNREAD_INFO_1', 'Mensagens n�o-lidas ficar�o na Caixa de Entrada por ');
DEFINE ('_UDDEIM_UNREAD_INFO_2', ' dias no m�x. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEIM_SENT_INFO_1', 'Mensagens Enviadas ficar�o na Caixa de Entrada por ');
DEFINE ('_UDDEIM_SENT_INFO_2', ' dias no m�x. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_HEAD', 'Mostrar aviso para mensagens lidas');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_EXP', 'Mostra na Caixa de Entrada o aviso "Mensagens lidas ser�o apagadas em n dias"');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_HEAD', 'Mostrar aviso para mensagens n�o-lidas');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_EXP', 'Mostra na Caixa de Entrada o aviso "Mensagens n�o-lidas ser�o apagadas em n dias"');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_HEAD', 'Mostrar aviso para mensagens enviadas');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_EXP', 'Mostra na Caixa de Sa�da o aviso "Mensagens enviadas ser�o apagadas depois de n dias"');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_HEAD', 'Mostrar aviso para mensagens exclu�das');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_EXP', 'Mostra na Lixeira o aviso "Mensagens na lixeira ser�o excu�das depois de n dias"');
DEFINE ('_UDDEADM_DELETESENTAFTER_HEAD', 'Mensagens enviadas s�o mantidas por (dias)');
DEFINE ('_UDDEADM_DELETESENTAFTER_EXP', 'Informe o n�mero de dias at� que as mensagens <b>enviadas</b> sejam automaticamente apagadas da Caixa de Sa�da.');
DEFINE ('_UDDEIM_SEND_TOALLSPECIAL', 'enviar � todos os usu�rios especiais');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLSPECIAL', 'Mensagem para <strong>todos os usu�rios especiais</strong>');
DEFINE ('_UDDEADM_USERSET_SELUSERNAME', '- selecionar nome de usu�rio -');
DEFINE ('_UDDEADM_USERSET_SELNAME', '- selecionar nome -');
DEFINE ('_UDDEADM_USERSET_EDITSETTINGS', 'Editar configura��es de usu�rio');
DEFINE ('_UDDEADM_USERSET_EXISTING', 'existente');
DEFINE ('_UDDEADM_USERSET_NONEXISTING', 'n�o-existente');
DEFINE ('_UDDEADM_USERSET_SELENTRY', '- selecione entrada -');
DEFINE ('_UDDEADM_USERSET_SELNOTIFICATION', '- selecionar notifica��o -');
DEFINE ('_UDDEADM_USERSET_SELPOPUP', '- selecionar popup -');
DEFINE ('_UDDEADM_USERSET_USERNAME', 'Nome de Usu�rio');
DEFINE ('_UDDEADM_USERSET_NAME', 'Nome');
DEFINE ('_UDDEADM_USERSET_NOTIFICATION', 'Notifica��o');
DEFINE ('_UDDEADM_USERSET_POPUP', 'Popup');
DEFINE ('_UDDEADM_USERSET_LASTACCESS', '�ltimo acesso');
DEFINE ('_UDDEADM_USERSET_NO', 'N�o');
DEFINE ('_UDDEADM_USERSET_YES', 'Sim');
DEFINE ('_UDDEADM_USERSET_UNKNOWN', 'desconhecido');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINEEXCEPT', 'Quando offline (exceto respostas)');
DEFINE ('_UDDEADM_USERSET_ALWAYSEXCEPT', 'Sempre (exceto respostas)');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINE', 'Quando offline');
DEFINE ('_UDDEADM_USERSET_ALWAYS', 'Sempre');
DEFINE ('_UDDEADM_USERSET_NONOTIFICATION', 'Sem notifica��o');
DEFINE ('_UDDEADM_WELCOMEMSG', "Bem-vindo ao uddeIM!\n\nVoc� instalou o uddeIM com sucesso.\n\nTente ver esta mensagem com temas diferentes. Voc� pode configur�-las na interface administrativa do uddeIM.\n\O nuddeIM � um projeto em desenvolvimento. Se voc� encontrar bugs ou vulnerabilidades, por favor notifique-as para mim, pois juntos n�s podemos fazer com que o uddeIM seja melhor.\n\nBoa sorte, e divirta-se!");
DEFINE ('_UDDEADM_UDDEINSTCOMPLETE', 'Instala��o do uddeIM completa.');
DEFINE ('_UDDEADM_REVIEWSETTINGS', 'Por favor continue na administra��o e verifique as configura��es.');
DEFINE ('_UDDEADM_REVIEWLANG', 'Caso voc� esteja rodando o CMS num conjunto de caracteres diferente do ISO 8859-1 certifique-se de ajustar as configura��es apropriadamente.');
DEFINE ('_UDDEADM_REVIEWEMAILSTOP', 'Depois da instala��o, todo tr�fego de e-mail do uddeIM (notifica��es, lembretes) � desativado ent�o os e-mails n�o s�o enviados enquanto voc� estiver fazendo seus testes. N�o se esque�a de desativar a op��o "parar e-mail", quando voc� tiver terminado.');
DEFINE ('_UDDEADM_MAXRECIPIENTS_HEAD', 'M�x. Destinat�rios');
DEFINE ('_UDDEADM_MAXRECIPIENTS_EXP', 'N�mero m�ximo de destinat�rios permitidos por mensagem (0=ilimitado)');
DEFINE ('_UDDEIM_TOOMANYRECIPIENTS', 'muitos destinat�rios');
DEFINE ('_UDDEIM_STOPPEDEMAIL', 'Envio de e-mails desativado.');
DEFINE ('_UDDEADM_SEARCHINSTRING_HEAD', 'Pesquisando no texto');
DEFINE ('_UDDEADM_SEARCHINSTRING_EXP', 'O Autocompletar pesquisa dentro do texto (caso contr�rio, pesquisa apenas do in�cio)');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_HEAD', 'Comportamento do link "Todos os Usu�rios"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_EXP', 'Escolha se o link "Todos os Usu�rios" deve ser ocultado, ou se sempre deve ser exibido para todos os usu�rios.');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_0', 'Ocultar link "Todos os Usu�rios"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_1', 'Mostrar link "Todos os Usu�rios"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_2', 'Sempre mostrar todos usu�rios');
DEFINE ('_UDDEADM_CONFIGNOTWRITEABLE', 'Configura��o n�o � edit�vel:');
DEFINE ('_UDDEADM_CONFIGWRITEABLE', 'Configura��o � edit�vel:');
DEFINE ('_UDDEIM_FORWARDLINK', 'encaminhar');
DEFINE ('_UDDEIM_RECIPIENTFOUND', 'destinat�rio encontrado');
DEFINE ('_UDDEIM_RECIPIENTSFOUND', 'destinat�rios encontrados');
DEFINE ('_UDDEADM_MAILSYSTEM_MOSMAIL', 'mosMail');
DEFINE ('_UDDEADM_MAILSYSTEM_PHPMAIL', 'php mail (padr�o)');
DEFINE ('_UDDEADM_MAILSYSTEM_HEAD', 'Sistema de Correio');
DEFINE ('_UDDEADM_MAILSYSTEM_EXP', 'Selecione o sistema de correio que o uddeIM deve usar para enviar notifica��es.');
DEFINE ('_UDDEADM_SHOWGROUPS_HEAD', 'Mostrar grupos do Joomla');
DEFINE ('_UDDEADM_SHOWGROUPS_EXP', 'Mostrar grupos do Joomla na lista geral da mensagem.');
DEFINE ('_UDDEADM_ALLOWFORWARDS_HEAD', 'Encaminhamento de mensagens');
DEFINE ('_UDDEADM_ALLOWFORWARDS_EXP', 'Permitir encaminhamento de mensagens.');
DEFINE ('_UDDEIM_FWDFROM', 'Mensagem oiginal de');
DEFINE ('_UDDEIM_FWDTO', 'para');

// New: 0.9+
DEFINE ('_UDDEIM_UNARCHIVE', 'Desarquivar mensagem');
DEFINE ('_UDDEIM_CANTUNARCHIVE', 'N�o � poss�vel desarquivar mensagem');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_HEAD', 'Permitir m�ltiplos destinat�rios');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_EXP', 'Permitir m�ltiplos destinat�rios (separados por v�rgula).');
DEFINE ('_UDDEIM_CHARSLEFT', 'caracteres restantes');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_HEAD', 'Mostrar contador de texto');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_EXP', 'Mostra um contador de texto que exibe quantos caracteres restam.');
DEFINE ('_UDDEIM_CLEAR', 'Limpar');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_HEAD', 'Incluir destinat�rios selecionados na lista');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_EXP', 'Isto permite a sele��o de m�ltiplos destinat�rios.');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_HEAD', 'Incluir conex�es selecionadas na lista');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_EXP', 'Isto permite a sele��o de m�ltiplos destinat�rios.');
DEFINE ('_UDDEADM_PMSFOUND', 'PMS encontrado: ');
DEFINE ('_UDDEIM_ENTERNAME', 'informe um nome');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_HEAD', 'Usar autocompletar');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_EXP', 'Use autocompletar para nomes de destinat�rios.');
DEFINE ('_UDDEADM_OBFUSCATING_HEAD', 'Chave usada para obfusca��o');
DEFINE ('_UDDEADM_OBFUSCATING_EXP', 'Digite a chave que � usada para a obfusca��o da mensagem. N�o mude este valor depois que a obfusca��o de mensagem tiver sido ativada.');
DEFINE ('_UDDEADM_CFGFILE_NOTFOUND', 'Arquivo de configura��o incorreto encontrado!');
DEFINE ('_UDDEADM_CFGFILE_FOUND', 'Vers�o encontrada:');
DEFINE ('_UDDEADM_CFGFILE_EXPECTED', 'Vers�o esperada:');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING', 'Convertendo configura��o...');
DEFINE ('_UDDEADM_CFGFILE_DONE', 'Conclu�do!');
DEFINE ('_UDDEADM_CFGFILE_WRITEFAILED', 'Erro Cr�tico: falha de escrita no arquivo de configura��o:');

// New: 0.8+
DEFINE ('_UDDEIM_ENCRYPTDOWN', 'Mensagem encriptografada! - n�o � poss�vel fazer download!');
DEFINE ('_UDDEIM_WRONGPASSDOWN', 'Senha incorreta! - n�o � poss�vel fazer download!');
DEFINE ('_UDDEIM_WRONGPW', 'Senha incorreta! - Por favor contate o administrador do banco de dados!');
DEFINE ('_UDDEIM_WRONGPASS', 'Senha incorreta!');
DEFINE ('_UDDEADM_MAINTENANCE_D1', 'Datas de Lixeira incorretas (Caixa de Entrada/Caixa de Sa�da): ');
DEFINE ('_UDDEADM_MAINTENANCE_D2', 'Corrigindo datas de Lixeira incorretas');
DEFINE ('_UDDEIM_TODP', 'Para: ');
DEFINE ('_UDDEADM_MAINTENANCE_PRUNE', 'Limpar mensagens agora');
DEFINE ('_UDDEADM_SHOWACTIONICONS_HEAD', 'Mostrar �cones de a��o');
DEFINE ('_UDDEADM_SHOWACTIONICONS_EXP', 'Quando definido <i>sim</i>, links de a��o ser�o exibidos com um �cone.');
DEFINE ('_UDDEIM_UNCHECKALL', 'desmarcar tudo');
DEFINE ('_UDDEIM_CHECKALL', 'marcar tudo');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_HEAD', 'Mostrar �cones abaixo');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_EXP', 'Quando definido <i>sim</i>, links abaixo ser�o exibidos com um �cone.');
DEFINE ('_UDDEADM_ANIMATED_HEAD', 'Usar smileys animados');
DEFINE ('_UDDEADM_ANIMATED_EXP', 'Usa smileys animados ao inv�s de est�ticos.');
DEFINE ('_UDDEADM_ANIMATEDEX_HEAD', 'Mais smileys animados');
DEFINE ('_UDDEADM_ANIMATEDEX_EXP', 'Mostra mais smileys animados.');
DEFINE ('_UDDEIM_PASSWORDREQ', 'Mensagem encriptografada - Senha requerida');
DEFINE ('_UDDEIM_PASSWORD', '<strong>Senha requerida</strong>');
DEFINE ('_UDDEIM_PASSWORDBOX', 'Senha');
DEFINE ('_UDDEIM_ENCRYPTIONTEXT', ' (texto de encriptografia)');
DEFINE ('_UDDEIM_DECRYPTIONTEXT', ' (texto de desencriptografia)');
DEFINE ('_UDDEIM_MORE', 'MAIS');
// uddeIM Module
DEFINE ('_UDDEMODULE_PRIVATEMESSAGES', 'Mensagens Privadas');
DEFINE ('_UDDEMODULE_NONEW', 'nenhuma nova');
DEFINE ('_UDDEMODULE_NEWMESSAGES', 'Novas mensagens: ');
DEFINE ('_UDDEMODULE_MESSAGE', 'mensagem');
DEFINE ('_UDDEMODULE_MESSAGES', 'mensegens');
DEFINE ('_UDDEMODULE_YOUHAVE', 'Voc� tem');
DEFINE ('_UDDEMODULE_HELLO', 'Ol�');
DEFINE ('_UDDEMODULE_EXPRESSMESSAGE', 'Mensagem R�pida');

// New: 0.7+
DEFINE ('_UDDEADM_USEENCRYPTION', 'Usar encriptografia');
DEFINE ('_UDDEADM_USEENCRYPTIONDESC', 'Encriptografar mensagens armazenadas');
DEFINE ('_UDDEADM_CRYPT0', 'Nenhum');
DEFINE ('_UDDEADM_CRYPT1', 'Obfuscar mensagens');
DEFINE ('_UDDEADM_CRYPT2', 'Encriptografar mensagens');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_HEAD', 'Padr�o para notifica��o por e-mail');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_EXP', 'Valor padr�o para notifica��o por e-mail (para usu�rios que ainda n�o alteraram suas prefer�ncias).');
DEFINE ('_UDDEADM_NOTIFYDEF_0', 'Sem notifica��o');
DEFINE ('_UDDEADM_NOTIFYDEF_1', 'Sempre');
DEFINE ('_UDDEADM_NOTIFYDEF_2', 'Notifica��o quando desconectado');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_HEAD', 'Ocultar link "Todos os Usu�rios"');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_EXP', 'Ocultar o link "Todos os Usu�rios" na caixa escrever nova mensagem (�til quando muitos usu�rios s�o registrados).');
DEFINE ('_UDDEADM_POPUP_HEAD','Notifica��o por popup');
DEFINE ('_UDDEADM_POPUP_EXP','Mostra um popup na chegada de uma nova mensagem (mod_uddeim ou o patched mod_cblogin � necess�rio)');
DEFINE ('_UDDEIM_OPTIONS', 'Mais configura��es');
DEFINE ('_UDDEIM_OPTIONS_EXP', 'Aqui voc� pode ajustar algumas outras configura��es.');
DEFINE ('_UDDEIM_OPTIONS_P', 'Mostrar um popup quando uma nova mensagem chegar');
DEFINE ('_UDDEADM_POPUPDEFAULT_HEAD', 'Notifica��o em popup por padr�o');
DEFINE ('_UDDEADM_POPUPDEFAULT_EXP', 'Ativa a notifica��o em popup por padr�o (para usu�rios que ainda n�o alteraram suas prefer�ncias).');
DEFINE ('_UDDEADM_MAINTENANCE', 'Manuten��o');
DEFINE ('_UDDEADM_MAINTENANCE_HEAD', 'Manuten��o do banco de dados');
DEFINE ('_UDDEADM_MAINTENANCE_CHECK', 'VERIFICAR');
DEFINE ('_UDDEADM_MAINTENANCE_TRASH', 'REPARAR');
DEFINE ('_UDDEADM_MAINTENANCE_EXP', "Quando um usu�rio foi apagado suas mensagens normalmente s�o mantidas no banco de dados. Esta fun��o verifica se � necess�rio descartar mensagens �rf�s e voc� pode descart�-las se for requisitado.<br />Isto tamb�m verifica o banco de dados por alguns erros que ent�o ser�o corrigidos.");
DEFINE ('_UDDEADM_MAINTENANCE_MC1', "Verificando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC2', "<i>#nnn (Nome de Usu�rio): [Caixa de Entrada|Entrada na Lixeira|Sa�da|Sa�da na Lixeira]</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC3', "<i>Entrada: mensagens armazenadas nas Caixas de Entrada dos usu�rios</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC4', "<i>Entrada na Lixeira: mensagens das Caixas de Entrada nas Lixeiras dos usu�rios, mas que continuam na Caixa de Sa�da de algu�m</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC5', "<i>Saida: mensagens armazenadas nas Caixas de Sa�da dos usu�rios</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC6', "<i>Sa�da na Lixeira: mensagens das Caixas de Sa�da nas Lixeiras dos usu�rios, mas que continuam na Caixa de Entrada de algu�m</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MT1', "Reparando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_NOTFOUND', "N�o encontrado (de/para/configura��es/bloqueador/bloqueado):");
DEFINE ('_UDDEADM_MAINTENANCE_MT2', "Deletar todas as prefer�ncias do usu�rio");
DEFINE ('_UDDEADM_MAINTENANCE_MT3', "Deletar bloqueio de usu�rio");
DEFINE ('_UDDEADM_MAINTENANCE_MT4', "Limpar a Caixa de Entrada do usu�rio deletado, e as respectivas mensagens da Caixa de Sa�da de remetentes");
DEFINE ('_UDDEADM_MAINTENANCE_MT5', "Limpar a Caixa de Sa�da do usu�rio deletado, e as respectivas mensagens da Caixa de Entrada de destinat�rios");
DEFINE ('_UDDEADM_MAINTENANCE_NOTHINGTODO', '<b>N�o h� nada � fazer</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_JOBTODO', '<b>Manuten��o requisitada</b><br />');

// New: 0.6+
DEFINE ('_UDDEADM_NAMESTEXT', 'Mostrar nomes verdadeiros');
DEFINE ('_UDDEADM_NAMESDESC', 'Mostrar nomes verdadeiros ou nomes de usu�rio?');
DEFINE ('_UDDEADM_REALNAMES', 'Nomes Verdadeiros');
DEFINE ('_UDDEADM_USERNAMES', 'Nomes de Usu�rio');
DEFINE ('_UDDEADM_CONLISTBOX', 'Listbox de conex�es');
DEFINE ('_UDDEADM_CONLISTBOXDESC', 'Mostrar minhas conex�es num listbox ou numa tabela?');
DEFINE ('_UDDEADM_LISTBOX', 'Listbox');
DEFINE ('_UDDEADM_TABLE', 'Tabela');

DEFINE ('_UDDEIM_TRASHCAN_INFO_1', 'As mensagens ficar�o na lixeira por ');
DEFINE ('_UDDEIM_TRASHCAN_INFO_2', ' horas antes de serem apagadas. Voc� s� poder� ver as primeiras palavras da mensagem. Para ler a mensagem completamente voc� ter� que restaur�-la.');
DEFINE ('_UDDEIM_RECALLEDMESSAGE_INFO', 'Esta mensagem esta em modo de edi��o. Voc� poder� edit�-la e reenvi�-la.');
DEFINE ('_UDDEIM_COULDNOTRECALL', 'Esta mensagem n�o pode ser editada (provavelmente porque foi lida ou apagada.)');
DEFINE ('_UDDEIM_CANTRESTORE', 'Falha ao restaurar mensagem. (� prov�vel que ela tenha sido transferida para a lixeira e depois apagada.)');
DEFINE ('_UDDEIM_COULDNOTRESTORE', 'Falha ao restaurar mensagem.');
DEFINE ('_UDDEIM_DONTSEND', 'N�o enviar');
DEFINE ('_UDDEIM_SENDAGAIN', 'Re-enviar');
DEFINE ('_UDDEIM_NOTLOGGEDIN', 'Voc� n�o esta logado.');
DEFINE ('_UDDEIM_NOMESSAGES_INBOX', '<strong>Voc� n�o tem mensagens em sua Caixa de Entrada.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_OUTBOX', '<strong>Voc� n�o tem mensagens em sua Caixa de Sa�da.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_TRASHCAN', '<strong>Voc� n�o tem mensagens em sua Lixeira.</strong>');
DEFINE ('_UDDEIM_INBOX', 'Caixa de Entrada');
DEFINE ('_UDDEIM_OUTBOX', 'Caixa de Sa�da');
DEFINE ('_UDDEIM_TRASHCAN', 'Lixeira');
DEFINE ('_UDDEIM_CREATE', 'Nova mensagem');
DEFINE ('_UDDEIM_UDDEIM', 'Mensagem Privada');
	// this is the headline/name of the component as it appears in Mambo

DEFINE ('_UDDEIM_READSTATUS', 'Lida');
	// as in 'this message has been "read"'

DEFINE ('_UDDEIM_FROM', 'De');
DEFINE ('_UDDEIM_FROM_SMALL', 'de');
DEFINE ('_UDDEIM_TO', 'Para');
DEFINE ('_UDDEIM_TO_SMALL', 'para');
DEFINE ('_UDDEIM_OUTBOX_WARNING', 'Sua Caixa de Sa�da cont�m todas as mensagens que voc� enviou mas que ainda n�o foram apagadas. Voc� poder� editar as mensagens na caixa de sa�da se elas n�o foram ainda lidas pelo destinat�rio. Durante a edi��o ela n�o ser� lida pelo destinat�rio. ');
DEFINE ('_UDDEIM_RECALL', 'editar');
DEFINE ('_UDDEIM_RECALLTHISMESSAGE', 'Editar esta mensagem');
DEFINE ('_UDDEIM_RESTORE', 'Restaurar');
DEFINE ('_UDDEIM_MESSAGE', 'Mensagem');
DEFINE ('_UDDEIM_DATE', 'Data');
DEFINE ('_UDDEIM_DELETED', 'Apagado');
DEFINE ('_UDDEIM_DELETE', 'Apagar');
DEFINE ('_UDDEIM_DELETELINK', 'Apagar');
DEFINE ('_UDDEIM_MESSAGENOACCESS', 'Esta mensagem n�o pode ser exibida. <br />Poss�veis raz�es:<ul><li>Voc� n�o tem permiss�o para ler essa mensagem privada</li><li>A mensagem foi apagada</li></ul>');
DEFINE ('_UDDEIM_YOUMOVEDTOTRASH', '<b>Voc� moveu esta mensagem para a lixeira</b>');
DEFINE ('_UDDEIM_MESSAGEFROM', 'Mensagem de ');
DEFINE ('_UDDEIM_MESSAGETO', 'Mensagem sua para ');
DEFINE ('_UDDEIM_REPLY', 'Resposta');
DEFINE ('_UDDEIM_SUBMIT', 'Enviar');
DEFINE ('_UDDEIM_NOMESSAGE', 'Erro: Esta faltando o texto da mensagem! Nenhuma mensagem foi enviada.');
DEFINE ('_UDDEIM_MESSAGE_REPLIEDTO', 'Resposta enviada');
DEFINE ('_UDDEIM_MESSAGE_SENT', 'Mensagem Enviada');
DEFINE ('_UDDEIM_MOVEDTOTRASH', ' e a mensagem original foi movida para a lixeira');
DEFINE ('_UDDEIM_NOSUCHUSER', 'O nome de usu�rio informado n�o foi encontrado!');
DEFINE ('_UDDEIM_NOTTOYOURSELF', 'N�o � poss�vel enviar mensagem para voc� mesmo!');
DEFINE ('_UDDEIM_PRUNELINK', 'Somente Admin.: Limpar');
DEFINE ('_UDDEIM_BLOCKS', 'Bloqueado');
DEFINE ('_UDDEIM_YOUAREBLOCKED', 'N�o enviado (o usu�rio o bloqueou)');
DEFINE ('_UDDEIM_BLOCKNOW', 'bloquear&nbsp;usu�rio');
DEFINE ('_UDDEIM_BLOCKS_EXP', 'Esta � uma lista de usu�rios bloqueados. Estes usu�rios n�o podem enviar mensagens privadas para voc�.');
DEFINE ('_UDDEIM_NOBODYBLOCKED', 'Voc� n�o tem nenhum usu�rio bloqueado.');
DEFINE ('_UDDEIM_YOUBLOCKED_PRE', 'Voc� bloqueou atualmente ');
DEFINE ('_UDDEIM_YOUBLOCKED_POST', ' usu�rio(s).');
DEFINE ('_UDDEIM_UNBLOCKNOW', '[desbloquear]');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_ON', 'Se um usu�rio bloqueado tentar lhe enviar uma mensagem, ele ser� informado que voc� o bloqueou e que a mensagem n�o pode ser enviada.');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_OFF', 'O usu�rio bloqueado n�o poder� saber que voc� o bloqueou.');
DEFINE ('_UDDEIM_CANTBLOCKADMINS', 'Voc� n�o poder� bloquear administradores.');
DEFINE ('_UDDEIM_BLOCKSDISABLED', 'Sistema de Bloqueio n�o habilitado');
DEFINE ('_UDDEIM_CANTREPLY', 'Voc� n�o pode enviar essa mensagem.');
DEFINE ('_UDDEIM_EMNOFF', 'O e-mail de notifica��o esta desligado. ');
DEFINE ('_UDDEIM_EMNON', 'O e-mail de notifica��o esta ligado. ');
DEFINE ('_UDDEIM_SETEMNON', '[ligado]');
DEFINE ('_UDDEIM_SETEMNOFF', '[desligado]');
DEFINE ('_UDDEIM_EMN_BODY_NOMESSAGE', 'Ol� %you%,

%user% lhe enviou uma mensagem privada em %site%.
Por favor � preciso estar logado para ler a mensagem!');
DEFINE ('_UDDEIM_EMN_BODY_WITHMESSAGE', 'Ol� %you%,

%user% lhe enviou a seguinte mensagem privada %site%.
Por favor � preciso estar logado para responder a mensagem!
__________________
%pmessage%
');
DEFINE ('_UDDEIM_EMN_FORGETMENOT', 'Ol� %you%,

voc� tem mensagens privadas n�o lidas em %site%.
Por favor fa�a o seu login para visualiza-la!
');
DEFINE ('_UDDEIM_EXPORT_FORMAT', '
================================================================================
%user% (%msgdate%)
----------------------------------------
%msgbody%
================================================================================');
DEFINE ('_UDDEIM_EMN_SUBJECT', 'Voc� tem mensagens no %site%');





DEFINE ('_UDDEIM_ARCHIVE_ERROR', 'Falha ao tentar arquivar mensagem.');
DEFINE ('_UDDEIM_ARC_SAVED_NONE', '<strong>Voc� n�o tem nenhuma mensagem arquivada.</strong>');
DEFINE ('_UDDEIM_ARC_SAVED_1', 'Voc� arquivou ');
DEFINE ('_UDDEIM_ARC_SAVED_2', ' mensagens');
DEFINE ('_UDDEIM_ARC_SAVED_ONE', 'Voc� arquivou uma mensagem');
DEFINE ('_UDDEIM_ARC_SAVED_3', 'Para salvar essa mensagem voc� ter� que primeiro apagar outra.');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_1', 'Voc� pode salvar no m�ximo ');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_2', ' mensagens.');

DEFINE ('_UDDEIM_INBOX_LIMIT_1', 'Voc� tem ');
DEFINE ('_UDDEIM_INBOX_LIMIT_2', ' mensagens em seu');
DEFINE ('_UDDEIM_ARC_UNIVERSE_ARC', 'arquivo');
DEFINE ('_UDDEIM_ARC_UNIVERSE_INBOX', 'Caixa de entrada');
DEFINE ('_UDDEIM_ARC_UNIVERSE_BOTH', 'Caixa de entrada e arquivo');
	// The lines above are to make up a sentence like
	// "You have | 126 | messages in your | inbox and archive"

DEFINE ('_UDDEIM_INBOX_LIMIT_3', 'O m�ximo permitido � ');
DEFINE ('_UDDEIM_INBOX_LIMIT_4', 'Voc� ainda pode receber e ler mensagens mas n�o poder� responder ou escrever at� que voc� apague alguma mensagem antiga.');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_1', 'Mensagens arquivadas: ');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_2', '(no max. ');
	// don't add closing bracket

DEFINE ('_UDDEIM_MESSAGE_ARCHIVED', 'Mensagens guardadas no arquivo.');
DEFINE ('_UDDEIM_STORE', 'arquivo');
	// translators info: as in: 'store this message in archive now'

DEFINE ('_UDDEIM_BACK', 'voltar');

DEFINE ('_UDDEIM_TRASHCHECKED', 'confirmando exclus�o de');
	// translators info: plural! (as in "delete checked" messages)
	
DEFINE ('_UDDEIM_SHOWALL', 'exibir todas');
	// translators example "SHOW ALL messages"
	
DEFINE ('_UDDEIM_ARCHIVE', 'Arquivo');
	// should be same as _UDDEADM_ARCHIVE
	
DEFINE ('_UDDEIM_ARCHIVEFULL', 'O arquivo esta cheio. N�o foi poss�vel salvar.');
	
DEFINE ('_UDDEIM_NOMSGSELECTED', 'Nenhuma mensagem selecionada.');
DEFINE ('_UDDEIM_THISISACOPY', 'Copia da mensagem enviada para ');
DEFINE ('_UDDEIM_SENDCOPYTOME', 'copia para mim');
	// as in 'send a "copy to me"' or cc: me

DEFINE ('_UDDEIM_SENDCOPYTOARCHIVE', 'copiar para o arquivo');
DEFINE ('_UDDEIM_TRASHORIGINAL', 'lixo original');

DEFINE ('_UDDEIM_MESSAGEDOWNLOAD', 'Download da Mensagem');
DEFINE ('_UDDEIM_EXPORT_MAILED', 'E-mail com mensagens exportadas');
DEFINE ('_UDDEIM_EXPORT_NOW', 'e-mail de confrma��o para mim');
	// as in "send the messages checked above by E-Mail to me"

DEFINE ('_UDDEIM_EXPORT_MAIL_INTRO', 'Esta e-mail cont�m sua mensaem privada.');
DEFINE ('_UDDEIM_EXPORT_COULDNOTSEND', 'N�o � poss�vel enviar e-mails que contenham mensagens.');

DEFINE ('_UDDEIM_LIMITREACHED', 'Limite da mensagem! N�o restaurado.');

DEFINE ('_UDDEIM_WRITEMSGTO', 'Escrever mensagem para ');
	// as in "write a message to" (a person)

// months and weeknames (please translate according 
// to your language)

$udde_smon[1]="Jan";
$udde_smon[2]="Fev";
$udde_smon[3]="Mar";
$udde_smon[4]="Abr";
$udde_smon[5]="Mai";
$udde_smon[6]="Jun";
$udde_smon[7]="Jul";
$udde_smon[8]="Ago";
$udde_smon[9]="Set";
$udde_smon[10]="Out";
$udde_smon[11]="Nov";
$udde_smon[12]="Dez";

$udde_lmon[1]="Janeiro";
$udde_lmon[2]="Fevereiro";
$udde_lmon[3]="Mar�o";
$udde_lmon[4]="Abril";
$udde_lmon[5]="Mai";
$udde_lmon[6]="Junho";
$udde_lmon[7]="Julho";
$udde_lmon[8]="Augosto";
$udde_lmon[9]="Setembro";
$udde_lmon[10]="Outubro";
$udde_lmon[11]="Novembro";
$udde_lmon[12]="Dezembro";

$udde_lweekday[0]="Domingo";
$udde_lweekday[1]="Segunda";
$udde_lweekday[2]="Ter�a";
$udde_lweekday[3]="Quarta";
$udde_lweekday[4]="Quinta";
$udde_lweekday[5]="Sexta";
$udde_lweekday[6]="S�bado";

$udde_sweekday[0]="Dom";
$udde_sweekday[1]="Seg";
$udde_sweekday[2]="Ter";
$udde_sweekday[3]="Qua";
$udde_sweekday[4]="Qui";
$udde_sweekday[5]="Sex";
$udde_sweekday[6]="Sab";

// *********************************************************
// the following can remain English
// *********************************************************

DEFINE ('_UDDEIM_NOID', 'Erro: N�o foi encontrado o ID do destinat�rio. Nenhuma mensagem enviada.');
DEFINE ('_UDDEIM_VIOLATION', '<b>Viola��o de acesso!</b> Voc� n�o tem permiss�o para executar essa a��o!');
DEFINE ('_UDDEIM_UNEXPECTEDERROR_QUIT', 'Erro inesperado: ');
DEFINE ('_UDDEIM_ARCHIVENOTENABLED', 'Arquivo n�o habilitado.');


// *********************************************************
// No translation necessary below this line
// *********************************************************

DEFINE ('_UDDEIM_ONLINEPIC', 'images/icon_online.gif');
DEFINE ('_UDDEIM_OFFLINEPIC', 'images/icon_offline.gif');

// Admin

DEFINE ('_UDDEADM_SETTINGS', 'Administra��o do uddeIM');
DEFINE ('_UDDEADM_GENERAL', 'Geral');
DEFINE ('_UDDEADM_ABOUT', 'Sobre');
DEFINE ('_UDDEADM_DATESETTINGS', 'Data/hora');
DEFINE ('_UDDEADM_PICSETTINGS', '�cones');
DEFINE ('_UDDEADM_DELETEREADAFTER_HEAD', 'Mensagens lidas s�o mantidas por (dias)');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_HEAD', 'Mensagens que n�o foram lidas s�o mantidas por (dias)');
DEFINE ('_UDDEADM_DELETETRASHAFTER_HEAD', 'Mensagens na lixeira s�o mantidas por (dias)');
DEFINE ('_UDDEADM_DAYS', 'dia(s)');
DEFINE ('_UDDEADM_DELETEREADAFTER_EXP', 'Defina o n�mero de dias em que as mensagens que j� foram lidas dever�o ser apagadas automaticamente da caixa de entrada. Se voc� n�o deseja que as mensagens sejam apagadas automaticamente, defina um valor alto (por exemplo, 36524 dias equivale a um s�culo). Mas esteja atento que o banco de dados poder� ficar muito cheio caso as mensagens n�o sejam apagadas.');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_EXP', 'Defina o n�mero de dias em que as mensagens <b>n�o lidas</b>, pelos destinat�rios, devem ser apagadas automaticamente.');
DEFINE ('_UDDEADM_DELETETRASHAFTER_EXP', 'Defina o n�mero de dias para que as mensagens sejam apagadas da lixeira automaticamente. Valores menores que 1 tamb�m s�o aceitos. Por Exemplo: para que as mensagens sejam apagadas da lixeira ap�s 3 horas, basta preencher com o n�mero 0.125.');
DEFINE ('_UDDEADM_DATEFORMAT_HEAD', 'Exibir o formato de data');
DEFINE ('_UDDEADM_DATEFORMAT_EXP', 'Escolha o formato de data/hora que ser� exibido juntamente com a mensagem. Meses ser�o abreviados de acordo com sua op��o de idioma que esta sendo utilizado pelo Joomla (caso exista o arquivo de idioma do uddeIM correspondente).');
DEFINE ('_UDDEADM_LDATEFORMAT_HEAD', 'formato longo de exibi��o da data');
DEFINE ('_UDDEADM_LDATEFORMAT_EXP', 'Escolha o formato da data que ser� exibida ao abrir a mensagem. Para semanas e meses, ser� usado o padr�o utilizado pelo mambo (se existir um arquivo de idiomas do uddeIM correspondente ao utilizado pelo Joomla).');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_HEAD', 'Dele��o Invocada');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_YES', 'apenas por administradores');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_NO', 'por qualquer usu�rio');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_EXP', 'Dele��es autom�ticas imp�em uma carga pesada nos servidores e bancos de dados. Se voc� escolher <i>apenas por administradores</i> as dele��es autom�ticas conforme as configura��es acima (das mensagens de todos os usu�rios) s�o invocadas quando qualquer administrador verificar a Caixa de Entrada dele. Escolha esta op��o se um administrador est� verificando a Caixa de Entrada uma vez por dia ou com mais frequ�ncia, que � o caso de muitos sites. (Se seu site tem mais do que um administrador, n�o importa qual deles efetua o login, uma vez que as dele��es s�o invocadas por qualquer administrador.) Em sites muito pequenos ou sites onde os administradores raramente verificam suas Caixas de Entrada, escolha <i>por qualquer usu�rio</i>. Se voc� n�o compreendeu isto, ou n�o sabe o que fazer, escolha <i>por qualquer usu�rio</i>.');
DEFINE ('_UDDEADM_SAVESETTINGS', 'Salvar Configura��o');
DEFINE ('_UDDEADM_THISHASBEENSAVED', 'A configura��o foi salva no arquivo config:');
DEFINE ('_UDDEADM_SETTINGSSAVED', 'As configura��es foram salvas.');
DEFINE ('_UDDEADM_ICONONLINEPIC_HEAD', '�cone: Usu�rio est� online');
DEFINE ('_UDDEADM_ICONONLINEPIC_EXP', 'Digite o endere�o da localiza��o do �cone, que ser� exibido quando o usu�rio estiver online.');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_HEAD', '�cone: Usu�rio esta offline');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_EXP', 'Digite o endere�o da localiza��o do �cone, que ser� exibido quando o usu�rio estiver offline.');
DEFINE ('_UDDEADM_ICONREADPIC_HEAD', '�cone: Mensagem Lida');
DEFINE ('_UDDEADM_ICONREADPIC_EXP', 'Digite o endere�o da localiza��o do �cone, que ser� exibido para Mensagens Lidas.');
DEFINE ('_UDDEADM_ICONUNREADPIC_HEAD', '�cone: Mensagem n�o Lida');
DEFINE ('_UDDEADM_ICONUNREADPIC_EXP', 'Digite o endere�o da localiza��o do �cone, que ser� exibido para Mensagens n�o Lidas.');
DEFINE ('_UDDEADM_MODULENEWMESS_HEAD', 'M�dulo: �cone Mensagens Novas');
DEFINE ('_UDDEADM_MODULENEWMESS_EXP', 'Esta configura��o se refere ao m�dulo mod_uddeim_new. Digite a localiza��o desse �cone, que ser� exibido quando houver mensagens novas.');
DEFINE ('_UDDEADM_UDDEINSTALL', 'Instala��o do uddeIM');
DEFINE ('_UDDEADM_FINISHED', 'A Instala��o foi finalizada. Seja Bem-vindo ao uddeIM. ');
DEFINE ('_UDDEADM_NOCB', '<span style="color: red;">Voc� n�o tem o Mambo Community Builder instalado. Voc� n�o poder� usar uddeIM.</span><br /><br />Voc� poder� fazer download no endere�o: <a href="http://www.mambojoe.com">Mambo Community Builder</a>.');
DEFINE ('_UDDEADM_CONTINUE', 'continue');
DEFINE ('_UDDEADM_PMSFOUND_1', 'H� ');
DEFINE ('_UDDEADM_PMSFOUND_2', ' mensagens em seu PMS. Voc� deseja importa-las para o uddeIM?');
DEFINE ('_UDDEADM_IMPORT_EXP', 'Isto n�o alterar� as mensagens de PMS e a sua instala��o eles permanecer�o intactos. Voc� poder� importar com seguran�a para o uddeIM e manter o PMS funcionando se desejar. (Voc� dever� primeiramete salvar as altera��es e a configura��o antes da promover a importa��o!) As mensagens que est�o no Banco de Dados do uddeIM ficar�o intactas.');
DEFINE ('_UDDEADM_IMPORT_YES', 'Importar mensagens do PMS para o uddeIM agora');
DEFINE ('_UDDEADM_IMPORT_NO', 'N�o, n�o importe nenhuma mensagem');
DEFINE ('_UDDEADM_IMPORTING', 'Aguarde as mensagens est�o sendo importadas.');
DEFINE ('_UDDEADM_IMPORTDONE', 'Conclu�da a importa��o das mensagens do PMS. N�o rode esse script novamente caso contr�rio as mensagens ficar�o duplicadas.');
DEFINE ('_UDDEADM_IMPORT', 'Importar');
DEFINE ('_UDDEADM_IMPORT_HEADER', 'Importar mensagens do PMS');
DEFINE ('_UDDEADM_PMSNOTFOUND', 'N�o encontramos o PMS instalado. Importa��o imporss�vel.');
DEFINE ('_UDDEADM_ALREADYIMPORTED', '<span style="color: red;">Voc� j� importou as mensagens do PMS para o uddeIM.</span>');
DEFINE ('_UDDEADM_BLOCKSYSTEM_HEAD', 'Habilitar o sistema de bloqueio');
DEFINE ('_UDDEADM_BLOCKSYSTEM_EXP', 'Quando estiver habilitado, os usu�rios ter�o permiss�o para bloquear outros usu�rios. O usu�rio bloqueado n�o poder� enviar mensagens para o usu�rio que o bloqueou. Administradores n�o podem ser bloqueados.');
DEFINE ('_UDDEADM_BLOCKSYSTEM_YES', 'sim');
DEFINE ('_UDDEADM_BLOCKSYSTEM_NO', 'n�o');
DEFINE ('_UDDEADM_BLOCKALERT_HEAD', 'Notificar o usu�rio que foi bloqueado');
DEFINE ('_UDDEADM_BLOCKALERT_EXP', 'Se voc� selecionar <i>sim</i>, o usu�rio bloqueado ser� notificado de que n�o poder� enviar a mensagem porque o destinat�rio o bloqueou. Se for selecionada a op��o <i>n�o</i>, o usu�rio bloqueado n�o ser� notificado que a mensagem n�o foi enviada.');
DEFINE ('_UDDEADM_BLOCKALERT_YES', 'sim');
DEFINE ('_UDDEADM_BLOCKALERT_NO', 'n�o');
DEFINE ('_UDDEADM_DELETIONS', 'Exclus�o');
DEFINE ('_UDDEADM_BLOCK', 'Bloqueando');
DEFINE ('_UDDEADM_INTEGRATION', 'Integra��o');
DEFINE ('_UDDEADM_EMAIL', 'E-mail');
DEFINE ('_UDDEADM_SHOWCBLINK_HEAD', 'Exibir links do CB');
DEFINE ('_UDDEADM_SHOWCBLINK_EXP', 'Ao selecionar <i>sim</i>, o perfil de todos os usu�rios ser� exibido no uddeIM atrav�s de um link do Community Builder.');
DEFINE ('_UDDEADM_SHOWCBPIC_HEAD', 'Exibir thumbnail do CB');
DEFINE ('_UDDEADM_SHOWCBPIC_EXP', 'Ao selecionar <i>sim</i>, o thumbnail do respectivo usu�rio ser� exibido quando a mensagem for lida (se o usu�rio possuir uma imagem no perfil do Community Builder).');
DEFINE ('_UDDEADM_SHOWONLINE_HEAD', 'Exibir status online');
DEFINE ('_UDDEADM_SHOWONLINE_EXP', 'Ao selecionar <i>sim</i>, o uddeIM exibe todos o  nomes de usu�rios atrav�s de um �cone pequeno que informar� se o usu�rio esta on-line ou offline. Voc� poder� definir a imagem dos �cone no painel de controle do administrador.');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_HEAD', 'Permitir e-mail de notifica��o');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_EXP', 'Ao selecionar <i>sim</i>, todos os usu�rios poder�o escolher se desejam receber um e-mail de notifica��o ao receber uma mensagem.');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_HEAD', 'O E-mail contem a mensagem');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_EXP', 'Ao selecionar <i>n�o</i>, este e-mail somente conter� informa��s resumidas de quando e quem enviou a mensagem.');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_HEAD', 'E-mail de Lembrete');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_EXP', 'Este recurso envia um e-mail aos usu�rios que t�m mensagens n�o-lidas na Caixa de Entrada, j� h� bastante tempo (defina abaixo). Esta op��o � independente da "permitir notifica��o por e-mail". Se voc� n�o quer enviar quaisquer mensagens de e-mail, ent�o deve desativar ambas as op��es.');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_HEAD', 'Lembrete enviado ap�s dia(s)');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_EXP', 'Se o recurso Lembrete (acima) est� com <i>sim</i>, defina em quantos dias dever� ser enviado o e-mail informando sobre as mensagens n�o-lidas.');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_HEAD', 'Lista de caracteres iniciais');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_EXP', 'Voc� poder� determinar aqui quantos caracteres podem ser exibidos na caixa de entrada, na caixa de sa�da e na lixeira.');
DEFINE ('_UDDEADM_MAXLENGTH_HEAD', 'Comprimento m�ximo da mensagem');
DEFINE ('_UDDEADM_MAXLENGTH_EXP', 'Selecione aqui o comprimento m�ximo da mensagem. Ela ser� removida automaticamente ap�s. Selecione  "0" para permitir o comprimento m�ximo da mensagem (n�o ecomendado).');
DEFINE ('_UDDEADM_YES', 'sim');
DEFINE ('_UDDEADM_NO', 'n�o');
DEFINE ('_UDDEADM_ADMINSONLY', 'somente admins');
DEFINE ('_UDDEADM_SYSTEM', 'Sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_HEAD', 'Nome de Usu�rio em Mensagens de Sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_EXP', 'O uddeIM suporta mensagens de sistema. Elas n�o tem um remetente vis�vel e os usu�rios n�o podem responder estas mensagens. Informe aqui o apelido do nome de usu�rio padr�o para as mensagens de sistema (por exemplo <i>Suporte</i> ou <i>Central de Ajuda</i> ou <i>Mestre da Comunidade</i>)');
DEFINE ('_UDDEADM_ALLOWTOALL_HEAD', 'Permitir que os administradores enviem mensagens gerais');
DEFINE ('_UDDEADM_ALLOWTOALL_EXP', 'O uddeIM suporta mensagens gerais. Elas s�o enviadas para cada usu�rio no seu sistema. Use-as moderadamente, sem exageros.');
DEFINE ('_UDDEADM_EMN_SENDERNAME_HEAD', 'Nome do remetente do e-mail');
DEFINE ('_UDDEADM_EMN_SENDERNAME_EXP', 'Digite o nome que ser� exibido no e-mail de notifica��o. (Por exemplo <i>Nome do  seu Site</i>)');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_HEAD', 'Endere�o do remetente do E-mail');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_EXP', 'Digite o endere�o de e-mail que ser� exibido no e-mail de notifica��o (pode ser o endere�o de contato do seu site.');
DEFINE ('_UDDEADM_VERSION', 'Vers�o do uddeIM');
DEFINE ('_UDDEADM_ARCHIVE', 'Arquivo'); // translators info: headline for Archive system
DEFINE ('_UDDEADM_ALLOWARCHIVE_HEAD', 'Habilitar arquivo');
DEFINE ('_UDDEADM_ALLOWARCHIVE_EXP', 'Escolha se os usu�rios ter�o permiss�o para arquivar as mensagens. Mensagens arquivadas n�o ser�o apagadas.');
DEFINE ('_UDDEADM_MAXARCHIVE_HEAD', 'Max de mensagens no arquivo do usu�rio');
DEFINE ('_UDDEADM_MAXARCHIVE_EXP', 'Defina quantas mensagens podem ser arquivadas (n�o haver� limites para os administradores).');
DEFINE ('_UDDEADM_COPYTOME_HEAD', 'Permitir c�pia');
DEFINE ('_UDDEADM_COPYTOME_EXP', 'Permitir que os usu�rios recebam c�pia das mensagens enviadas. As c�pias ir�o para a caixa de entrada.');
DEFINE ('_UDDEADM_MESSAGES', 'Mensagens');
DEFINE ('_UDDEADM_TRASHORIGINAL_HEAD', 'Enviar para a lixeira mensagens respondidas');
DEFINE ('_UDDEADM_TRASHORIGINAL_EXP', 'Quando ativado, a op��o "Enviar para a lixeira mensagens respondidas" � a padr�o. Nesse caso, a mensagem ser� movida da caixa de entrada para a lixeira ap�s ser respondida. Esta op��o reduz o n�mero de mensagens no banco de Dados. Os usu�rios poder�o desmarcar essa op��o para que as mensagens permane�am na Caixa de Entrada.');
	// translators info: 'Send' is the same as _UDDEIM_SUBMIT, 
	// and 'trash original' the same as _UDDEIM_TRASHORIGINAL
DEFINE ('_UDDEADM_PERPAGE_HEAD', 'Messagens por p�gina');
DEFINE ('_UDDEADM_PERPAGE_EXP', 'Defina aqui o n�mero de mensagens exibidas por p�gina na caixa de Entrada, caixa de Sa�da, Lixeira e arquivo.');
DEFINE ('_UDDEADM_CHARSET_HEAD', 'Caractere usado');
DEFINE ('_UDDEADM_CHARSET_EXP', 'Se voc� est� tendo problemas de exibi��o de caracteres n�o-latinos, voc� pode informar aqui qual charset que o uddeIM usar� para converter a sa�da do bando de dados para o c�digo HTML. <b>Se voc� n�o sabe o que isso significa, n�o modifique o valor padr�o!</b>');
DEFINE ('_UDDEADM_MAILCHARSET_HEAD', 'Charset usado no e-mail');
DEFINE ('_UDDEADM_MAILCHARSET_EXP', 'Se voc� est� tendo problemas de exibi��o de caracteres n�o-latinos, voc� pode indormar aqui qual charset que o uddeIM usar� para enviar e-mails. <b>Se voc� n�o sabe o que isso significa, n�o modifique o valor padr�o!</b>');
		// translators info: if you're translating into a language that uses a latin charset
		// (like English, Dutch, German, Swedish, Spanish, ... ) you might want to add a line
		// saying 'For usage in [mylanguage] the default value is correct.'
DEFINE ('_UDDEADM_EMN_BODY_NOMESSAGE_EXP', 'Esse � o conte�do do e-mail que o usu�rio receber� quando essa op��o for selecionada. O conte�do da mensagem n�o estar� no e-mail. Mantenha as vari�veis %you%, %user% e %site% intactas. ');
DEFINE ('_UDDEADM_EMN_BODY_WITHMESSAGE_EXP', 'Esse � o conte�do do e-mail que o usu�rio receber� quando essa op��o for selecionada. Este e-mail n�o ser� inclu�do no conte�do da mensagem. Mantenha as vari�veis %you%, %user%, %pmessage% e %site% intactas. ');
DEFINE ('_UDDEADM_EMN_FORGETMENOT_EXP', 'Esse � o conte�do do e-mail de lembrete que o usu�rio receber� quando a op��o for selecionada. Mantenha as vari�veis %you% e %site% intactas. ');		
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_EXP', 'Permitir aos usu�rios fazer o download das suas mensagens arquivadas, ao envi�-las por e-mail deles para eles mesmos.');
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_HEAD', 'Permitir download');
DEFINE ('_UDDEADM_EXPORT_FORMAT_EXP', 'Este � o formado do e-mail que os usu�rios ir�o receber quando eles fazem o download de suas pr�prias mensagens do arquivo. Mantenha as vari�veis %user%, %msgdate% e %msgbody% intactas. ');	
		// translators info: Don't translate %you%, %user%, etc. in the strings above. 
DEFINE ('_UDDEADM_INBOXLIMIT_HEAD', 'Selecione o limite da Caixa de Entrada');
DEFINE ('_UDDEADM_INBOXLIMIT_EXP', 'Voc� poder� definir o n�mero de mensagens na Caixa de Entrada e no arquivo. Nesse caso o n�mero de mensagens n�o poder� ultrapassar o valor fixado. Alternativamente, voc� poder� selecionar o limte da caixa de sa�da. Nesse caso os usu�rios n�o ter�o conhecimento do n�mero de mensagens exibidas na caixa de sa�da. Se o limite for atingido o usu�rio n�o poder� responder ou compor novas mensagens at� que eles apaguem as mensagens antigas tanto na caixa de sa�da ou no arquivo.');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_HEAD', 'Exibir limite usado na Caixa de Entrada');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_EXP', 'Exibir quantas mensagens os usu�rios est�o armazenando (e quanto � permitido armazenar) na linha abaixo da Caixa de Entrada.');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INTRO', 'Voc� esta saindo do Arquivo. Como deseja controlar as mensagens que s�o salvas no arquivo?');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_LINK', 'Deixe-as');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_EXP', 'Deixe-as no Arquivo (o usu�rio n�o ser� capaz de acess�-las e elas continuar�o contando para fins de limites de mensagens).');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_LINK', 'Mover para Caixa de Entrada');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_DONE', 'Mensagem Arquivada movida para lixeira');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_EXP', 'A mensagem foi movida para a caixa de entrada do usu�rio (or to trash if they are older than allowed in the inbox).');

		
// 0.4 frontend, but visible admins only (no translation necessary)		

DEFINE ('_UDDEIM_SEND_ASSYSM', 'enviar mensagem de sistema (=destinat�rio n�o pode responder)');
DEFINE ('_UDDEIM_SEND_TOALL', 'enviar para todos os usu�rios');
DEFINE ('_UDDEIM_SEND_TOALLADMINS', 'enviar para todos os admins');
DEFINE ('_UDDEIM_SEND_TOALLLOGGED', 'enviar para todos os usu�rios on-line');
DEFINE ('_UDDEIM_VALIDFOR_1', 'v�lido para ');
DEFINE ('_UDDEIM_VALIDFOR_2', ' horas. 0=para sempre (exclus�o autom�tica)');
DEFINE ('_UDDEIM_WRITE_SYSM_GM', '[Criar uma mensagem de sistema ou geral]');
DEFINE ('_UDDEIM_WRITE_NORMAL', '[Criar uma mensagem normal (padr�o)]');
DEFINE ('_UDDEIM_NOTALLOWED_SYSM_GM', 'Mensagens de sistema e geral n�o permitidas.');
DEFINE ('_UDDEIM_SYSGM_TYPE', 'Tipo de mensagem');
DEFINE ('_UDDEIM_HELPON_SYSGM', 'Ajuda em mensagem de sistema');
DEFINE ('_UDDEIM_HELPON_SYSGM_2', '(abrir em uma nova janela)');

DEFINE ('_UDDEIM_SYSGM_PLEASECONFIRM', 'Voc� est� a ponto de enviar a mensagem exibida abaixo. Por favor fa�a uma revis�o e confirme ou cancele!');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALL', 'Mensagem para <strong>todos os usu�rios</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLADMINS', 'Mensagem para<strong>todos os administradores</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLLOGGED', 'Mensagem para  <strong>todos que est�o atualmente logados como usu�rios</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLDISABLEREPLY', 'Os destinat�rios n�o poder�o responder a esta mensagem.');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_1', 'Mensagem ser� enviada com <strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_2', '</strong> como nome de usu�rio');

DEFINE ('_UDDEIM_SYSGM_WILLEXPIRE', 'Mensagem ir� expirar ');
DEFINE ('_UDDEIM_SYSGM_WILLNOTEXPIRE', 'Mensagem n�o expira');
DEFINE ('_UDDEIM_SYSGM_CHECKLINK', '<b>Confira o link (clicando nele) antes de prosseguir!</b>');
DEFINE ('_UDDEIM_SYSGM_SHORTHELP', 'Usar <strong>em mensagens de sistema somente</strong>:<br /> [b]<strong>negrito</strong>[/b] [i]<em>it�lico</em>[/i]<br />
[url=http://www.algumsite.com]texto com link url[/url] ou [url]http://www.algumsite.com[/url] s�o links');
DEFINE ('_UDDEIM_SYSGM_ERRORNORECIPS', 'Erro: Nenhum destinat�rio encontrado. Mensagem n�o enviada.');
		
// new in 0.5 ADMIN

// Translators observe: Search for _UDDEIM_SYSGM_SHORTHELP (above)
// and change this text so that it no longer contains 
// information abouth the [newurl] code. [newurl] is no 
// longer supported by this version of uddeIM.
// already done in this file!
// 
// PLEASE
// When you're done translating, please change the

	// version       0.4+

// at the top of this file into

	// version       0.5

// and delete the line right after it that says

	// (0.4 plus 0.5 strings in English)

// as well as these comments. Thank you.

DEFINE ('_UDDEADM_TEMPLATEDIR_HEAD', 'Tema do uddeIM');
DEFINE ('_UDDEADM_TEMPLATEDIR_EXP', 'Escolha qual tema voc� deseja que o uddeIM use');
DEFINE ('_UDDEADM_SHOWCONNEX_HEAD', 'Mostrar Conex�es CB');
DEFINE ('_UDDEADM_SHOWCONNEX_EXP', 'Use <i>sim</i> se voc� tem o Community Builder instalado e quer apresentar ao usu�rio os nomes das conex�es dele durante a composi��o de uma nova mensagem.');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_HEAD', 'Mostrar configura��es');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_EXP', 'O link de configura��es aparece no uddeIM se voc� ativar a notifica��o por e-mail ou o sistema de bloqueio. Se voc� n�o quer isso, voc� pode deixar aqui desligado. ');
DEFINE ('_UDDEADM_SHOWSETTINGS_ATBOTTOM', 'sim, no final');
DEFINE ('_UDDEADM_ALLOWBB_HEAD', 'Permitir BB codes');
DEFINE ('_UDDEADM_FONTFORMATONLY', 'Apenas Formata��o de Fonte');
DEFINE ('_UDDEADM_ALLOWBB_EXP', 'Use <i>apenas formata��o de fonte</i> para permitir que os usu�rios usem os bb codes para negrito, it�lico, subescrito, cor da fonte e tamanho da fonte. Quando voc� deixa esta op��o com <i>sim</i>, os usu�rios podem usar <strong>todos</strong> os BB codes suportados nas mensagens deles (inclusive para inser��o de links e imagens).');
DEFINE ('_UDDEADM_ALLOWSMILE_HEAD', 'Permitir Emoticons');
DEFINE ('_UDDEADM_ALLOWSMILE_EXP', 'Se definir <i>sim</i>, c�digos de atalho de emoticon como :-) s�o substitu�dos com a imagem do emoticon na exibi��o da mensagem. Veja o arquivo README para uma lista com os emoticons suportados.');
DEFINE ('_UDDEADM_DISPLAY', 'Exibi��o');
DEFINE ('_UDDEADM_SHOWMENUICONS_HEAD', 'Mostrar �cones de Menu');
DEFINE ('_UDDEADM_SHOWMENUICONS_EXP', 'Se definir <i>sim</i>, os links de menu e de a��o ser�o exibidos com um �cone.');
DEFINE ('_UDDEADM_SHOWTITLE_HEAD', 'T�tulo do Componente');
DEFINE ('_UDDEADM_SHOWTITLE_EXP', 'Informe o cabe�alho para o componente de mensagem privada, por exemplo "Mensagens Privadas". Deixe vazio se voc� n�o deseja mostrar um cabe�alho.');
DEFINE ('_UDDEADM_SHOWABOUT_HEAD', 'Mostrar link Sobre');
DEFINE ('_UDDEADM_SHOWABOUT_EXP', 'Se definir <i>sim</i> aparece um link de cr�ditos e licen�a de software do uddeIM. Este link aparecer� no final da sa�da HTML do uddeIM.');
DEFINE ('_UDDEADM_STOPALLEMAIL_HEAD', 'Interromper e-mail agora');
DEFINE ('_UDDEADM_STOPALLEMAIL_EXP', 'Marque esta caixa para evitar que o uddeIM envie e-mails (notifica��es e lembretes) independente das configura��es do usu�rio, quando por exemplo, estiver testando o site. Se voc� n�o quer que estes recursos funcionem nunca, defina todas as op��es acima com <i>n�o</i>.');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_MANUALLY', 'manualmente');
DEFINE ('_UDDEADM_GETPICLINK_HEAD', 'Minitaura do CB em listas');
DEFINE ('_UDDEADM_GETPICLINK_EXP', 'Defina com <i>sim</i> se voc� quer mostrar as miniaturas do Community Builder dos usu�rios, nas exibi��es de listas de mensagens (Caixa de Entrada, Caixa de Sa�da, etc.)');

// new in 0.5 FRONTEND

DEFINE ('_UDDEIM_SHOWUSERS', 'Mostrar usu�rios');
DEFINE ('_UDDEIM_CONNECTIONS', 'Conex�es');
DEFINE ('_UDDEIM_SETTINGS', 'Configura��es');
DEFINE ('_UDDEIM_NOSETTINGS', 'N�o h� configura��es para ajustar.');
DEFINE ('_UDDEIM_ABOUT', 'Sobre'); // as in "About uddeIM"
DEFINE ('_UDDEIM_COMPOSE', 'Nova mensagem'); // as in "write new message", but only one word
DEFINE ('_UDDEIM_EMN', 'E-mail de notifica��o');
DEFINE ('_UDDEIM_EMN_EXP', 'Voc� pode receber um e-mail quando recebe mensagens privadas.');
DEFINE ('_UDDEIM_EMN_ALWAYS', 'E-mail de notifica��o para novas mensagenes');
DEFINE ('_UDDEIM_EMN_NONE', 'Sem e-mail de notifica��o');
DEFINE ('_UDDEIM_EMN_WHENOFFLINE', 'E-mail de notifica��o quando offline (desconectado do site)');
DEFINE ('_UDDEIM_EMN_NOTONREPLY', 'N�o envie notifica��o em respostas');
DEFINE ('_UDDEIM_BLOCKSYSTEM', 'Bloqueio de usu�rio'); // Headline for blocking system in settings
DEFINE ('_UDDEIM_BLOCKSYSTEM_EXP', 'Voc� pode evitar que usu�rios lhe enviem mensagens, bloqueando-os. Escolha <i>bloquear usu�rio</i> quando voc� v� uma mensagem daquele usu�rio.'); // block user is the same as _UDDEIM_BLOCKNOW
DEFINE ('_UDDEIM_SAVECHANGE', 'Salvar altera��es');
DEFINE ('_UDDEIM_TOOLTIP_BOLD', 'BB Code para texto em negrito. Exemplo: [b]negrito[/b]');
DEFINE ('_UDDEIM_TOOLTIP_ITALIC', 'BB Code para texto em it�lico. Exemplo: [i]it�lico[/i]');
DEFINE ('_UDDEIM_TOOLTIP_UNDERLINE', 'BB Code para texto sublinhado. Exemplo: [u]sublinhado[/u]');
DEFINE ('_UDDEIM_TOOLTIP_COLORRED', 'BB Code para cor vermelha. Exemplo [color=#ff4040]vermelho[/color] onde o #ff4040 � o c�digo hexadecimal da cor vermelha.');
DEFINE ('_UDDEIM_TOOLTIP_COLORGREEN', 'BB Code para cor verde. Exemplo [color=#40ff40]verde[/color] onde o #40ff40 � o c�digo hexadecimal da cor verde.');
DEFINE ('_UDDEIM_TOOLTIP_COLORBLUE', 'BB Code para cor azul. Exemplo [color=#4040ff]azul[/color] onde o #4040ff � o c�digo hexadecimal da cor azul.');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE1', 'BB Code para letras muito pequenas. Exemplo: [size=1]letras muito pequenas.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE2', 'BB Code para letras pequenas. Exemplo: [size=2]letras pequenas.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE4', 'BB Code para letras grandes. Exemplo: [size=4]letras grandes.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE5', 'BB Code para letras muito grandes. Exemplo: [size=5]letras muito grandes.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_IMAGE', 'BB Code para inserir uma imagem. Exemplo: [img]link_da_imagem[/img]');
DEFINE ('_UDDEIM_TOOLTIP_URL', 'BB Code para inserir um link. Exemplo: [url]www.algumsite.com[/url]. Procure sempre informar o http:// no link.');
DEFINE ('_UDDEIM_TOOLTIP_CLOSEALLTAGS', 'Fechar as tags de BB code abertas.');
DEFINE ('_UDDEIM_INBOX_LIMIT_2_SINGULAR', ' mensagem na sua'); // same as _UDDEIM_INBOX_LIMIT_2, but singular (as in 1 "message in your")
DEFINE ('_UDDEIM_ARC_SAVED_NONE_2', '<strong>Voc� n�o tem mensagens em seu arquivo.</strong>'); 
