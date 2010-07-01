<?php
//
// Copyright (C) 2004 W.H.Welch
// All rights reserved.
//
// This source file is part of the 404SEF Component, a Mambo 4.5.1
// custom Component By W.H.Welch - http://sef404.sourceforge.net/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// Please note that the GPL states that any headers in files and
// Copyright notices as well as credits in headers, source files
// and output (screens, prints, etc.) can not be removed.
// You can extend them with your own credits, though...
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Dutch translation for http://www.joomlacommunity.eu/ by Marieke van der Tuin, taal@joomlacommunity.eu
//
// Additions by Yannick Gaultier (c) 2006-2010
// Dont allow direct linking
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

define('_COM_SEF_404PAGE','404 Pagina');
define('_COM_SEF_ADD','Toevoegen');
define('_COM_SEF_ADDFILE','Standaard index bestand');
define('_COM_SEF_ASC',' (Oplopend) ');
define('_COM_SEF_BACK','Terug naar het controlepaneel van sh404SEF');
define('_COM_SEF_BADURL','De oude niet-SEF URL moet beginnen met index.php');
define('_COM_SEF_CHK_PERMS','U dient uw bestandsrechten na te kijken om er zeker van te zijn dat dit bestand gelezen kan worden.');
define('_COM_SEF_CONFIG','sh404SEF<br/>Instellingen');
define('_COM_SEF_CONFIG_DESC','Stel alle mogelijkheden van sh404SEF in');
define('_COM_SEF_CONFIG_UPDATED','Instellingen bijgewerkt');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Wilt u de inhoud van de URL cache wissen? Dit is erg aanbevolen nadat u uw instellingen heeft gewijzigd. Bezoek opnieuw uw website om de cache weer te cree&euml;n. Het is overigens beter om een sitemap voor uw website te maken.');
define('_COM_SEF_COPYRIGHT','Copyright');
define('_COM_SEF_DATEADD','Datum toegevoegd');
define('_COM_SEF_DEBUG_DATA_DUMP','Fouten verwijdering uit de data dump voltooid: Laden van de pagina be&euml;indigd');
define('_COM_SEF_DEF_404_MSG','<h1>Bad karma : we can\'t find that page !</h1>
<p>You asked for <strong>{%sh404SEF_404_URL%}</strong>, but despite our computers looking very hard, we could not find it. What happened ?</p>
<ul>
<li>the link you clicked to arrive here has a typo in it</li>
<li>or somehow we removed that page, or gave it another name</li>
<li>or, quite unlikely for sure, maybe you typed it yourself and there was a little mistake ?</li>
</ul>
<h4>{sh404sefSimilarUrlsCommentStart}It\'s not the end of everything though : you may be interested in the following pages on our site:{sh404sefSimilarUrlsCommentEnd}</h4>
<p>{sh404sefSimilarUrls}</p>
<p> </p>');
define('_COM_SEF_DEF_404_PAGE','Standaard 404 Pagina');
define('_COM_SEF_DESC',' (Aflopend) ');
define('_COM_SEF_DISABLED',"<p class='error'>LET OP: SEF ondersteuning in Joomla is op dit moment uitgeschakeld. Schakel SEF in via uw<a href='".$GLOBALS['shConfigLiveSite']."/administrator/index.php?option=com_config'> Algemene instellingen</a> SEO pagina.</p>");
define('_COM_SEF_EDIT','Bewerk');
define('_COM_SEF_EMPTYURL','U moet een URL opgeven voor doorverwijzing');
define('_COM_SEF_ENABLED','Activeer');
define('_COM_SEF_ERROR_IMPORT','Foutmelding tijdens het importeren:');
define('_COM_SEF_EXPORT','Backup links');
define('_COM_SEF_EXPORT_FAILED','EXPORTEREN MISLUKT!!!');
define('_COM_SEF_FATAL_ERROR_HEADERS','FATALE FOUTMELDING: DE HEADER IS REEDS VERZONDEN');
define('_COM_SEF_FRIENDTRIM_CHAR','Verwijder karakters');
define('_COM_SEF_HELP','sh404SEF<br/>Omdersteuning');
define('_COM_SEF_HELPDESC','Hulp nodig met sh404SEF?');
define('_COM_SEF_HELPVIA','<b>U kunt hulp krijgen via de volgende fora: </b>');
define('_COM_SEF_HIDE_CAT','Verberg categorie');
define('_COM_SEF_HITS','Hits');
define('_COM_SEF_IMPORT','Importeer aangepaste URL\'s');
define('_COM_SEF_IMPORT_EXPORT','Importeer/Exporteer URL\'s');
define('_COM_SEF_IMPORT_OK','Aangepaste URL\'s zijn succesvol ge&iuml;mporteerd!');
define('_COM_SEF_INFO','sh404SEF<br/>Documentatie');
define('_COM_SEF_INFODESC','Bekijk de samenvatting en de documentatie van het sh404SEF Project');
define('_COM_SEF_INSTALLED_VERS','Ge&iuml;nstalleerde versie:');
define('_COM_SEF_INVALID_SQL','ONGELDIGE DATA IN SQL BESTAND:');
define('_COM_SEF_INVALID_URL','ONGELDIGE URL: deze link dient een geldige Itemid te bevatten, maar er is er geen gevonden voor deze link.<br/>OPLOSSING: Maak een menu item aan voor dit onderdeel. U hoeft het niet te publiceren, het aanmaken ervan is voldoende.');
define('_COM_SEF_LICENSE','Licentie');
define('_COM_SEF_LOWER','Geen hoofdletters gebruiken');
define('_COM_SEF_MAMBERS','Mambers Forum');
define('_COM_SEF_NEWURL','Oude geen-SEF URL');
define('_COM_SEF_NO_UNLINK','Niet in staat om het ge&uuml;ploade bestand vanuit de media-map te verplaatsen');
define('_COM_SEF_NOACCESS','Niet in staat om toegang te krijgen');
define('_COM_SEF_NOCACHE','Geen caching');
define('_COM_SEF_NOLEADSLASH','Er dient geen slash teken voor de nieuwe SEF URL te staan.');
define('_COM_SEF_NOREAD','FATALE FOUTMELDING: Niet in staat om dit bestand te lezen: ');
define('_COM_SEF_NORECORDS','Geen records gevonden.');
define('_COM_SEF_OFFICIAL','Officieel Project Forum');
define('_COM_SEF_OK',' Oke ');
define('_COM_SEF_OLDURL','Niewe SEF URL');
define('_COM_SEF_PAGEREP_CHAR','Karakter tussen verschillende pagina\'s');
define('_COM_SEF_PAGETEXT','Pagina tekst');
define('_COM_SEF_PROCEED',' Voortgang ');
define('_COM_SEF_PURGE404','Verwijder<br/>404 Logs');
define('_COM_SEF_PURGE404DESC','Verwijder 404 Logs');
define('_COM_SEF_PURGECUSTOM','Verwijder<br/>Aangepaste doorverwijzingen');
define('_COM_SEF_PURGECUSTOMDESC','Verwijder Aangepaste doorverwijzingen');
define('_COM_SEF_PURGEURL','Verwijder<br/>SEF URL\'s');
define('_COM_SEF_PURGEURLDESC','Verwijder SEF URL\'s');
define('_COM_SEF_REALURL','Echte URL');
define('_COM_SEF_RECORD',' record');
define('_COM_SEF_RECORDS',' records');
define('_COM_SEF_REPLACE_CHAR','Vervangend karakter');
define('_COM_SEF_SAVEAS','Sla op als aangepaste doorverwijzing');
define('_COM_SEF_SEFURL','SEF URL');
define('_COM_SEF_SELECT_DELETE','Selecteer een artikel om te verwijderen');
define('_COM_SEF_SELECT_FILE','U dient eerst een bestand te selecteren');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Activeer iJoomla magazine in de inhoud');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Voeg ISO code toe');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'Voortgang URL');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Vertaal URL');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Voeg altijd een Itemid toe aan de SEF URL');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menu id');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Voeg altijd de menu titel toe');
define('_COM_SEF_SH_CACHE_TITLE', 'Cache beheer');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Tabel');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Voeg Community Builder naam toe');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Voeg gebruikers ID toe');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Voeg gebruikersnaam toe');
define('_COM_SEF_SH_CB_NAME', 'Standaard CB naam');
define('_COM_SEF_SH_CB_TITLE', 'Community Builder instellingen ');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Vul gebruikers alias toe');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Geavanceerd');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'Component');
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Hoofd');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Standaard menu titel');
define('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Voeg geen codes toe');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Overschrijf sef_ext niet');
define('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Niet vertalen');
define('_COM_SEF_SH_ENCODE_URL', 'Encodeer URL');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Voeg categorie ID toe');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Voeg categorienaam toe');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Voeg bericht ID toe');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Voeg berichtonderwerp toe');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Voeg de naam van Kunena toe');
define('_COM_SEF_SH_FB_NAME', 'Standaard Kunena naam');
define('_COM_SEF_SH_FB_TITLE', 'Kunena instellingen ');
define('_COM_SEF_SH_FILTER', 'Filter');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Gebruik geen SEF voor HTTPS');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Raad Itemid van uw homepagina');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Standaard magazine naam');
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'iJoomla Magazine instellingen');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Voeg menu Itemid toe als er geen beschikbaar is voor de specieke inhoud');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Voeg artikel ID toe aan URL');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Voeg kwestie id toe aan URL');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Voeg magazine id toe aan URL');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Voeg magazine naam toe aan URL');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Voeg taalcodes toe aan URL');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Voeg numeriek id toe aan URL');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Alle categorie&euml;n');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Pas toe bij de volgende categorie&euml;n');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Uniek ID');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Voeg product ID toe aan URL');
define('_COM_SEF_SH_INSERT_PRODUCT_NAME', 'Voeg productnaam toe aan URL'); 
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Voeg menu titel toe als er geen Itemid is');
define('_COM_SEF_SH_ITEMID_TITLE', 'Itemid beheer');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Standaard Itemid voor Letterman pagina');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Letterman instellingen ');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'SSL veilige URL');
define('_COM_SEF_SH_LOG_404_ERRORS', 'Log 404 foutmeldingen');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Cache grootte');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Overschrijf sef_ext bestand');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Aangepast');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_TOTAL', 'Totaal');
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 doorverwijzen van JOOMLA SEF naar sh404SEF');
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 doorverwijzen van geen-SEF naar SEF URL');
define('_COM_SEF_SH_REPLACEMENTS', 'Vervangingslijst van karakters');
define('_COM_SEF_SH_SHOP_NAME', 'Standaard winkelnaam');
define('_COM_SEF_SH_TRANSLATE_URL', 'Vertaal URL');
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Vertaalbeheer');
define('_COM_SEF_SH_USE_URL_CACHE', 'Activeer URL cache');
define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Toegevoegde tekst');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Geen');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Voeg categorie&euml;n toe');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Voeg categorie ID toe aan URL');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Vul de flypage naam in');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Voeg bedrijfs ID toe');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Voeg bedrijfsnaam toe aan URL');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Voeg de winkelnaam toe aan URL');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Alle geneste categorie&euml;n');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Alleen laatste');
define('_COM_SEF_SH_VM_TITLE', 'Virtuemart instellingen');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Gebruik product SKU als naam');
define('_COM_SEF_SHOW_CAT', 'Toon Categorie');
define('_COM_SEF_SHOW_SECT','Toon Sectie');
define('_COM_SEF_SHOW0','Toon SEF URL\'s');
define('_COM_SEF_SHOW1','Toon 404 Log');
define('_COM_SEF_SHOW2','Toon aangepaste doorverwijzingen');
define('_COM_SEF_SKIP','Sla over');
define('_COM_SEF_SORTBY','Sorteer op:');
define('_COM_SEF_STRANGE','Er is iets vreemds gebeurd. Dit had niet mogen gebeuren<br />');
define('_COM_SEF_STRIP_CHAR','Verwijder karakters');
define('_COM_SEF_SUCCESSPURGE','Records succesvol verwijderd');
define('_COM_SEF_SUFFIX','Bestand suffix');
define('_COM_SEF_SUPPORT','Ondersteunings<br/>Website');
define('_COM_SEF_SUPPORT_404SEF','Help ons');
define('_COM_SEF_SUPPORTDESC','Ga naar de sh404SEF website (nieuw venster)');
define('_COM_SEF_TITLE_ADV','Geavanceerde component instellingen');
define('_COM_SEF_TITLE_BASIC','Basis instellingen');
define('_COM_SEF_TITLE_CONFIG','sh404SEF Instellingen');
define('_COM_SEF_TITLE_MANAGER','sh404SEF URL beheer');
define('_COM_SEF_TITLE_PURGE','sh404SEF Verwijder Database');
define('_COM_SEF_TITLE_SUPPORT','sh404SEF Ondersteuning');
define('_COM_SEF_TT_404PAGE','Statische content pagina gebruiken als 404 Niet Gevonden foutmelding');
define('_COM_SEF_TT_ADDFILE','Bestandsnamen plaatsen achter een lege URL / als er geen bestand bestaat. Handig voor bots die uw site doorzoeken voor specifieke bestanden, maar vastlopen door een 404 pagina.');
define('_COM_SEF_TT_ADV','<b>gebruik standaard</b><br/>zoals normaal, als een geavanceerde SEF extensie aanwezig is wordt deze in plaats van dit gebruikt.<br/><b>geen caching</b><br/>Sla het niet in uw database op en maak oude SEF URL\'s. <br/><b>sla over</b><br/>Maak geen SEF URL\'s voor dit component<br/>');
define('_COM_SEF_TT_ADV4','Geavanceerde opties voor ');
define('_COM_SEF_TT_ENABLED','Als u dit instelt op nee zal de standaard SEF voor Joomla! worden gebruikt');
define('_COM_SEF_TT_FRIENDTRIM_CHAR','Karakters die verwijderd dienen te worden uit de URL, gescheiden door |');
define('_COM_SEF_TT_LOWER','Wijzig alle karakters naar kleine letters in de URL','Alles met kleine letters');
define('_COM_SEF_TT_NEWURL','Deze URL dient te beginnen met index.php');
define('_COM_SEF_TT_OLDURL','Alleen relatieve doorverwijzingen vanaf de Joomla! hoofdmap <i>zonder</i> het voorste slash teken');
define('_COM_SEF_TT_PAGEREP_CHAR','Te gebruiken karakter om pagina nummers van de rest te scheiden in de URL');
define('_COM_SEF_TT_PAGETEXT','Tekst toegevoegd aan een URL voor meerdere pagina\'s. Gebruik $s om een paginanummer toe te voegen, als u het standaard laat zal deze op het eind worden weergegeven. Als er een suffix is gedefinieerd zal deze worden toegevoegd aan het einde van deze string.');
define('_COM_SEF_TT_REPLACE_CHAR','Karakter om onbekende karakters mee te vervangen in de URL');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Als deze is ingesteld op <strong>ja</strong>, dan wordt de id uit com_content component ge&iuml;nterpreteerd als een iJoomla magazine editie id.');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Voor elk ge&iuml;nstalleerd component, en wanneer uw site meertalig is, kies om de ISO taalcode toe te voegen aan de SEF URL. Bijvoorbeeld : www.monsite.com/<b>fr</b>/introduction.html. fr staat voor Frans. Deze code wordt niet toegevoegd aan de URL\'s in de standaardtaal.');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Voor elk ge&iuml;nstalleerd component:<br /><b> gebruik standaard</b><br/> zoals normaal, als een geavanceerde SEF extensie aanwezig is zal hij deze vervangen.<br/><b>nocache</b><br/>Sla niet op in de database en maak in plaats daarvan SEF URL\'s in de oude stijl. <br/><b>sla over</b><br/>Maak geen SEF URL\'s voor dit component<br/>');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Een aantal componenten hebben hun eigen sef_ext bestanden gemaakt voor Joomla SEF, OpenSEF of geavanceerde SEF. Als deze parameter aan is gezet, zal dit extensie bestand niet gebruikt worden, en de sh404SEF plugin wel  (ervanuit gaande dat er een is voor dat component). Zo niet, zal het sef_ext bestand van de extensie worden gebruikt.');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Voor elk ge&iuml;nstalleerd component, selecteer of de URL vertaald moet worden. Dit heeft geen effect als uw site maar een taal bevat.');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Als u deze instelt op Ja, zal de geen-SEF Itemid (of de Itemid van het menu item als er niets als geen-SEF URL staat) toegevoegd worden aan de SEF URL. Dit dient u te gebruiken in plaats van de menutitel parameter, als u verschillende menu items heeft met dezelfde titel (bijvoorbeeld een uit het hoofdmenu en een uit het topmenu)');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Als u deze instelt op Ja, zal de titel van het menu item worden toegevoegd aan de SEF URL.');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Als u deze instelt op Ja, zal de titel van het menu element die leidt tot de hoofdpagina van Community Builder worden toegevoegd aan alle CB SEF URL\'s.');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Als u deze instelt op Ja, zal de gebruikers ID worden toegevoegd aan de naam, alleen waneer de vorige optie op Ja staat ingestelt. U dient dit te gebruiken wanneer twee gebruikers dezelfde naam hebben.');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Als u deze instelt op Ja, zal de gebruikersnaam worden toegevoegd aan de SEF URL\'s. <strong>LET OP</strong>: dit kan leiden tot een enorme vergroting van de database en uw site vertragen, als u veel geregistreerde gebruikers heeft. Als u deze instelt op Nee, zal de gebruikers ID worden gebruikt, in normaal formaat : ..../send-user-email.html?user=245');
define('_COM_SEF_TT_SH_CB_NAME', 'Als u de vorige parameter heeft ingestelt op Ja, kunt u deze tekst uit de SEF URL hier overschrijven. Deze tekst is niet variabel, en zal bijvoorbeeld niet vertaald worden.');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Als u deze instelt op Ja, zal de gebruikers alias worden toegevoegd aan de SEF URL, als u de bovenstaande optie heeft geactiveerd, in plaats van de echte naam.');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Als u de bovenstaande parameter op Ja instelt, kunt u deze tekst uit de SEF URL hier overschrijven. Deze tekst is niet variabel, en zal bijvoorbeeld niet vertaald worden.');
define('_COM_SEF_TT_SH_ENCODE_URL', 'Als u deze instelt op Ja, zal de URL gecodeerd worden zodat deze compatibel is met talen die niet-latijnse karakters bevatten. Een gecodeerde URL ziet er als volg uit : mijnsite.nl/%34%56%E8%67%12.....');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Als u deze instelt op Ja, zal de categorie ID worden toegevoegd aan de naam, als de vorige optie op Ja staat ingesteld. U dient dit te gebruiken als twee categorie&euml;n dezelfde naam hebben.');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Als u deze instelt op Ja, zal de categorienaam worden toegevoegd aan alle SEF links van berichten en categorie&euml;n.');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Als u deze instelt op Ja, zal elke bericht ID worden toegevoegd aan het onderwerp, als u de vorige optie ook op Ja heeft ingestelt. U dient dit te gebruiken als twee berichten hetzelfde onderwerp hebben.');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Als u deze instelt op Ja, zal elk berichtenonderwerp worden toegevoegd aan de SEF URL voorafgaand aan dit bericht.');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Als u deze instelt op Ja, zal de titel van het menu element dat leidt tot de hoofdpagina van Kunena worden toegevoegd aan alle Kunena SEF URL\'s.');
define('_COM_SEF_TT_SH_FB_NAME', 'Als u deze instelt op Ja, zal de naam van Kunena (gedefinieerd als de titel van het menu item) altijd worden toegevoegd aan de SEF URL.');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'Als u deze instelt op Ja, zal de URL een geen-SEF URL worden wanneer u naar de SSL modus (HTTPS) gaat. Dit zou anders problemen kunnen veroorzaken met sommige SSL servers.');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'Als u deze instelt op Ja, en alleen op de hoofdpagina, zullen alle Itemid en com_content URL\'s vervangen worden door gissingen van sh404SEF. Dit is handig wanneer inhoud elementen op de voorpagina worden weergegeven, maar ook op andere pagina\'s te bezichtigen zijn.');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Als u de vorige parameter op Ja heeft ingestelt, kunt u deze tekst uit de SEF URL hier overschrijven. Deze zal niet variabel zijn, en bijvoorbeeld niet vertaald worden.');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Als er geen Itemid aan de geen-SEF URL wordt toegevoegd voordat deze in een SEF URL veranderd, en u stelt deze optie in op Ja, zal het menu itemid worden toegevoegd. Dit zorgt ervoor dat u naar de juiste pagina wordt doorverwezen.');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Als u deze instelt op Ja, zal de artikel ID worden toegevoegd aan elke artikeltitel in een URL, zoals in : <br /> mijnsite.nl/Joomla-magazine/<strong>56</strong>-Goede-artikel-titel.html');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Als u deze instelt op Ja, zal een unieke interne id worden toegevoegd aan elk probleem, om er zeker van te zijn dat deze uniek is.');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Als u deze instelt op Ja, zal de magazine ID worden toegevoegd aan elke magazine naam in een URL, zoals in : <br /> mijnsite.nl/<strong>4</strong>-Joomla-magazine/Goede-artikel-titel.html');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Als u deze instelt op Ja, zal de naam van het magazine (gedefineerd als menu item titel) altijd worden toegevoegd aan de SEF URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Als u deze instelt op Ja, zal de ISO code van de pagina taal worden toegevoegd aan de SEF URL, tenzij de taal gelijk is aan de standaard site taal.');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Als u deze instelt op Ja, zal een numerieke id worden toegevoegd aan de URL, om diensten aan te bieden zoals Google nieuws. De id zal er zo uit zien : 2007041100000, waarbij 20070411 de datum van cre&euml;en voorstelt, en 00000 het unieke interne id van deze inhoud. U dient tenslotte de datum van aanmaken in te stellen, waneer deze gereed is voor publicatie. Deze dient u niet later te veranderen.');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Numerieke id zal worden toegevoegd aan SEF URL\'s van de categorie inhoud. U kunt meerdere categorie&euml;n selecteren door het ingedrukt houden van de CTRL toets.' );
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Als u deze instelt op Ja, zal de product ID worden toegevoegd aan de productnaam in de SEF URL<br />Bijvoorbeeld : mijnsite.nl/3-mijn-mooiste-product.html.<br />Dit is handig als u de categorienamen niet toevoegd aan de URL. Verschillende producten kunnen dezelfde naam dragen in verschillende categorie&euml;n. Let u alstublieft op het feit dat dit niet de product SKU is, maar een unieke interne product id. ');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Als u geen Itemid heeft ingesteld in de niet-SEF URL voordat het een SEF URL wordt, en u stelt deze optie in op Ja, zal de titel van het menu item toegevoegd worden aan de SEF URL. Dit dient u in te stellen wanneer u bovenstaande parameter ook op Ja is ingesteld, zodat u geen -2, -3, -... zal krijgen als u hetzelfde artikel vanaf verschillende locaties bekijkt.');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Voeg de Itemid van de toe te voegen pagina toe aan Letterman links');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Stel deze in op de <strong>volledige basis URL van uw site in SSL modus</strong><br />Alleen noodzakelijk als u https toegang heeft. als u deze niet instelt, zal deze standaard httpS://normaleSiteURL. zijn<br />Vult u alstublieft een volledige URL in, zonder een slash aan het einde. Bijvoorbeeld : <strong>https://www.mijnsite.nl</strong> of <strong>https://gedeeldesslserver.com/mijnaccount</strong>.');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Als u deze instelt op Ja, zullen 404 foutmeldingen bewaard worden in uw database. Dit kan u helpen met het vinden van foutmeldingen in uw site links. Dit kan veel database ruimte gebruiken, dus u kunt het beter op Nee instellen als uw site goed getest is.');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Als URL caching geactiveerd is, zal deze parameter de maximale grootte bepalen. Voer het maximale aantal URL\'s in die kunnen worden opgeslagen. Iedere URL is ongeveer 200 byte. 5000 URL\'s gebruiken dus ongeveer 1Mb aan ruimte.');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Als u deze instelt op Ja, zal de Joomla! standaard SEF URL 301 doorverwezen worden naar hun gelijke van sh404SEF, als die in de database beschikbaar zijn. Als deze niet bestaan, zal deze gemaakt worden wanneer nodig, tenzij er POST data is, dan gebeurt er niets. Warning: this feature will work in most cases, but may give bad redirects for some Joomla SEF URL. Leave off if possible.');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Als u deze instelt op Ja, zullen geen-SEF URL\'s die al in de database aanwezig zijn worden doorverwezen naar sh404SEF, gebruikmakend van een 301 - permanent verplaatst doorverwijzing. Als de SEF URL niet bestaat, zal het aangemaakt worden, behalve als er POST data wordt gevraagd op de pagina.');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Karakters die niet zijn toegestaan in de URL, zoals niet-Latijn of accenten, kunnen vervangen worden volgens deze vervangings tabel.<br />Formaat is xxx | yyy voor elke vervangings regel. xxx is het karakter dat vervangen moet worden en yyy is het nieuwe karakter. <br />Er kunnen vele van deze regels worden gemaakt, elk gescheiden door een komma (,). Tussen het oude en het nieuwe karakter dient u een | teken te plaatsen. <br />Let op dat xxx en yyy ook kunnen staan voor meerdere karakters, zoals in Å’|oe ');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Wanneer u de bovenstaande parameter op Ja heeft ingesteld, kunt u de in te voegen tekst overschrijven. Deze tekst is niet variabel en zal bijvoorbeeld niet vertaald worden.');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Indien geactiveerd, en de site is meertalig, zullen SEF URL elementen vertaald worden naar de taal van de bezoeker, via Joomfish bepaald. Als deze gedeactiveerd is, zal de URL altijd in de standaard taal van de site zijn. Deze optie wordt niet gebruikt bij sites die niet meertalig zijn.');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Indien geactiveerd, zal de SEF URL opgeslagen worden in een innerlijke cache, wat de pagina laadtijd aanzienlijk verminderd. Dit gebruikt wel geheugen!');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Als u deze instelt op Ja, zal er een tekst toegevoegd worden om te zoeken in verschillende categorie&euml;n. Bijvoorbeeld : ..../categorie-A/Bekijk-alle-producten.html VS ..../categorie-A/ .');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Als u deze instelt op Geen, zal geen enkele categorienaam worden toegevoegd aan de URL die leidt tot de product weergave, zoals in : <br /> mijnsite.nl/joomla-cms.html<br />Als u deze instelt op Alleen laatste, zal de naam van de categorie in welke het product thuishoort toegevoegd worden in de SEF URL, zoals in : <br /> mijnsite.nl/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Als u deze instelt op Ja, zal de categorie ID worden toegevoegd aan de URL die tot het product leidt, zoals in : <br /> mijnsite.nl/1-software/4-cms/1-joomla/joomla-cms.html');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Als u deze instelt op Ja, zal de flypage naam toegevoegd worden aan de URL die tot de product details leidt. Deze kan voor de rest gedeactiveerd worden als u alleen een flypage gebruikt.');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Als u deze instelt op Ja, zal de bedrijfs ID worden toegevoegd aan het bedrijf in de SEF URL<br />Bijvoorbeeld : mijnsite.nl/6-fabrikant/3-mijn-mooiste-product.html.');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Als u deze instelt op Ja, zal het bedrijf, als deze er is, worden toegevoegd aan de SEF URL die leidt tot een product<br />Bijvoorbeeld : mijnsite.nl/fabrikant/product-naam.html');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Als u deze instelt op Ja, zal de naam van de winkel altijd worden toegevoegd aan de SEF URL.');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Als u deze instelt op Ja, zal de product SKU, de product code die u voor elke product toevoegd, gebruikt worden in plaats van de volledige naam.');
define('_COM_SEF_TT_SHOW_CAT','Stel in op Ja om de categorienaam toe te voegen aan de URL');
define('_COM_SEF_TT_SHOW_SECT','Stel in op Ja om de sectienaam toe te voegen aan de URL');
define('_COM_SEF_TT_STRIP_CHAR','Karakters die uit de URL worden verwijderd, gescheiden door |');
define('_COM_SEF_TT_SUFFIX','Extensies gebruikt voor \'bestanden\'. Laat leeg om uit te schakelen. Een algemene invulling is \'html\'.');
define('_COM_SEF_TT_USE_ALIAS','Stel in op Ja om de titel_alias in plaats van de titel in de URL');
define('_COM_SEF_UNWRITEABLE',' <b><font color="red">Onschrijfbaar</font></b>');
define('_COM_SEF_UPLOAD_OK','Bestand is succesvol ge&uuml;pload');
define('_COM_SEF_URL','URL');
define('_COM_SEF_URLEXIST','Deze URL bestaat reeds in de database!');
define('_COM_SEF_USE_ALIAS','Gebruik titel alias');
define('_COM_SEF_USE_DEFAULT','(Gebruik standaard)');
define('_COM_SEF_USING_DEFAULT',' <b><font color="red">Gebruik standaard waarden</font></b>');
define('_COM_SEF_VIEW404','Bekijk/Bewerk<br/>404 Logs');
define('_COM_SEF_VIEW404DESC','Bekijk/Bewerk 404 Logs');
define('_COM_SEF_VIEWCUSTOM','Bekijk/Bewerk<br/>Aangepaste doorverwijzingen');
define('_COM_SEF_VIEWCUSTOMDESC','Bekijk/Bewerk Aangepaste doorverwijzingen');
define('_COM_SEF_VIEWMODE','WeergaveModus:');
define('_COM_SEF_VIEWURL','Bekijk/Bewerk<br/>SEF Url\'s');
define('_COM_SEF_VIEWURLDESC','Bekijk/Bewerk SEF Url\'s');
define('_COM_SEF_WARNDELETE','LET OP!!!  U staat op het punt om te verwijderen ');
define('_COM_SEF_WRITE_ERROR','Foutmelding schrijfbaarheid van instellingen');
define('_COM_SEF_WRITE_FAILED','Niet in staat om het ge&uuml;ploade bestand naar de media map te plaatsen');
define('_COM_SEF_WRITEABLE',' <b><font color="green">Schrijfbaar</font></b>');
define('_FULL_TITLE', 'Volledige titel');
define('_PREVIEW_CLOSE','Sluit dit venster');
define('_TITLE_ALIAS', 'Titel Alias');

// V 1.2.4.s
define('_COM_SEF_SH_DOCMAN_TITLE', 'Docman instellingen');
define('_COM_SEF_SH_DOCMAN_INSERT_NAME', 'Voeg Docman naam toe');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_NAME', 'Als u deze instelt op <strong>Ja</strong>, zal de menu element titel die naar de Docman hoofdpagina leidt worden toegevoegd aan alle Docman SEF URL\'s');
define('_COM_SEF_SH_DOCMAN_NAME', 'Standaard Docman naam');
define('_COM_SEF_TT_SH_DOCMAN_NAME', 'Wanneer de vorige parameter is ingesteld op Ja, kunt u de tekst die wordt toegevoegd aan de SEF URL hier wijzigen. Let op dat deze tekst hetzelfde blijft en bijvoorbeeld ook niet wordt vertaald.');
define('_COM_SEF_SH_DOCMAN_INSERT_DOC_ID', 'Voeg document ID toe');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_DOC_ID', 'Als u deze instelt op <strong>Ja</strong>, zal de document ID worden toegevoegd aan de URL, wat nodig is in het geval dat documenten dezelfde namen hebben.');
define('_COM_SEF_SH_DOCMAN_INSERT_DOC_NAME', 'Vul document naam in');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_DOC_NAME', 'Als u deze instelt op <strong>Ja</strong>, zal deze naam worden toegevoegd aan alle Docman SEF URL\'s');
define('_COM_SEF_SH_MYBLOG_TITLE', 'MyBlog instellingen');
define('_COM_SEF_SH_MYBLOG_INSERT_NAME', 'Voeg MyBlog naam toe');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_NAME', 'Als u deze instelt op <strong>Ja</strong>, zal de menu element titel welke leidt naar de hoofdpagina van MyBlog, worden toegevoegd aan alle MyBlog SEF URL\'s');
define('_COM_SEF_SH_MYBLOG_NAME', 'Standaard Myblog naam');
define('_COM_SEF_TT_SH_MYBLOG_NAME', 'Wanneer de vorige parameter is ingesteld op Ja, kunt u de tekst die wordt toegevoegd aan de SEF URL hier wijzigen. Let op dat deze tekst hetzelfde blijft en bijvoorbeeld ook niet wordt vertaald.');
define('_COM_SEF_SH_MYBLOG_INSERT_POST_ID', 'Voeg bericht ID toe');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_POST_ID', 'Als u deze instelt op <strong>Ja</strong>, zal het bericht ID worden toegevoegd aan de URL, wat nodig is in het geval dat berichten dezelfde namen hebben.');
define('_COM_SEF_SH_MYBLOG_INSERT_TAG_ID', 'Voeg tag id toe');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_TAG_ID', 'Als u deze instelt op <strong>Ja</strong>, zal de interne tag ID worden toegevoegd aan de tag naam, wat nodig is voor het geval dat er verwarring kan ontstaan met een andere categorienaam.');
define('_COM_SEF_SH_MYBLOG_INSERT_BLOGGER_ID', 'Voeg blogger ID toe');
define('_COM_SEF_TT_SH_MYBLOG_INSERT_BLOGGER_ID', 'Als u deze instelt op <strong>Ja</strong>, zal de interne blogger ID worden toegevoegd aan de bloggernaam, wat nodig is voor het geval dat verschillende bloggers dezelfde naam hebben.');
define('_COM_SEF_SH_RW_MODE_NORMAL', 'met .htaccess (mod_rewrite)');
define('_COM_SEF_SH_RW_MODE_INDEXPHP', 'zonder .htaccess (index.php)');
define('_COM_SEF_SH_RW_MODE_INDEXPHP2', 'met .htaccess (index.php?)');
define('_COM_SEF_SH_SELECT_REWRITE_MODE', 'Herschrijf modus');
define('_COM_SEF_TT_SH_SELECT_REWRITE_MODE', 'Selecteer een herschrijf modus voor sh404SEF.<br /><strong>met .htaccess (mod_rewrite)</strong><br />Standaard modus : U dient een .htaccess bestand te hebben, welke goed is ingesteld en past bij de instellingen van de server.<br /><strong>zonder .htaccess (index.php)</strong><br /><strong>EXPERIMENTEEL :</strong>U heeft geen .htaccess bestand nodig. Deze modus gebruikt de PahtInfo functie van Apache servers. Url\'s zullen beginnen met /index.php/. Het is niet onmogelijk dat IIS servers deze URL\'s accepteren.<br /><strong>zonder .htaccess (index.php?)</strong><strong>EXPERIMENTEEL :</strong>Deze modus is gelijk aan de vorige modus, behalve dat hier /index.php?/ wordt gebruikt in plaats van /index.ph/.<br />');
define('_COM_SEF_SH_RECORD_DUPLICATES', 'Record gekopieerde URL');
define('_COM_SEF_TT_SH_RECORD_DUPLICATES', 'Als deze is ingesteld op<strong>Ja</strong>, zal sh404SEF alle niet SEF URL\'s onthouden die dezelfde SEF URL hebben. Dit betekent dat u kunt kiezen naar welke uw voorkeur uitgaat, gebruikmakend van het Kopieer Beheer.');
define('_COM_SEF_META_TITLE', 'Titel tag');
define('_COM_SEF_TT_META_TITLE', 'Vul de tekst in die toegevoegd dient te worden aan de <strong>META Titel</strong> tag voor de geselecteerde URL.');
define('_COM_SEF_META_DESC', 'Beschrijvings tag');
define('_COM_SEF_TT_META_DESC', 'Vul de tekst in die toegevoegd dient te worden aan de <strong>META Beschrijving</strong> tag voor de gelecteerde URL.');
define('_COM_SEF_META_KEYWORDS', 'Sleutelwoorden tag');
define('_COM_SEF_TT_META_KEYWORDS', 'Vul de tekst in die toegevoegd dient te worden aan de <strong>META Sleutelwoorden</strong> tag voor de geselecteerde URL. Alle woorden of groepen van woorden dienen gescheiden te worden met een komma.');
define('_COM_SEF_META_ROBOTS', 'Robots tag');
define('_COM_SEF_TT_META_ROBOTS', 'Vul de tekst in die toegevoegd dient te worden aan de <strong>META Robots</strong> tag voor de geselecteerde URL. Deze tag vertelt de zoekmachines of deze links dienen te volgen op deze pagina, en wat te doen met de inhoud van deze pagina. Algemene waardes :<br /><strong>INDEX,FOLLOW</strong> : index is de actuele pagina inhoud, en volgt alle links die deze vindt op de pagina<br /><strong>INDEX,NO FOLLOW</strong> : de inhoud van de actuele pagina mag worden ge&iuml;ndexeerd, maar robots mogen de links op deze pagina niet volgen.<br /><strong>NO INDEX, NO FOLLOW</strong> : de actuele pagina mag niet ge&iuml;ndexeerd worden, en de links op deze pagina mogen ook niet gevolgd worden.<br />');
define('_COM_SEF_META_LANG', 'Taal tag');
define('_COM_SEF_TT_META_LANG', 'Vul de tekst in die wordt toegevoegd aan de <strong>META http-equiv= Inhoud-Taal </strong> tag voor de geselecteerde URL. ');
define('_COM_SEF_SH_CONF_TAB_META', 'META/SEO');
define('_COM_SEF_SH_CONF_META_DOC', 'Voor sh404SEF zijn verschillende plugins beschikbaar die <strong>automatisch</strong> META tags maken voor sommige componenten. Probeer deze niet handmatig te maken, tenzij u de automatisch gemaakte tags niet vindt passen !!<br />');
define('_COM_SEF_SH_REMOVE_JOOMLA_GENERATOR', 'Verwijder Joomla Generator tag');
define('_COM_SEF_TT_SH_REMOVE_JOOMLA_GENERATOR', 'Als u deze instelt op <strong>Ja</strong>, zal de generator = Joomla META tag verwijderd worden.');
define('_COM_SEF_SH_PUT_H1_TAG', 'Voeg h1 tags toe');
define('_COM_SEF_TT_SH_PUT_H1_TAG', 'Als u deze instelt op <strong>Ja</strong>, worden normale titels van de inhoud geplaatst tussen h1 tags. Deze titels worden normaal gesproken door Joomla geplaatst in de CSS class <strong>contentheading</strong>.');
define('_COM_SEF_SH_META_MANAGEMENT_ACTIVATED', 'Activeer META beheer');
define('_COM_SEF_TT_SH_META_MANAGEMENT_ACTIVATED', 'Als u deze instelt op <strong>Ja</strong>, kunnen titel, omschrijving, sleutelwoorden, robots en taal META tags beheerd worden door sh404SEF. Anders zullen de originele waardes door Joomla en/of andere componenten geproduceerd onaangetast blijven.  ');
define('_COM_SEF_TITLE_META_MANAGEMENT', 'META tags beheer');
define('_COM_SEF_META_EDIT', 'Bewerk tags');
define('_COM_SEF_META_ADD', 'Voeg tags toe');
define('_COM_SEF_META_TAGS', 'META tags');
define('_COM_SEF_META_TAGS_DESC', 'Maak/bewerk META tags');
define('_COM_SEF_PURGE_META_DESC', 'Verwijder META tags');
define('_COM_SEF_PURGE_META', 'Verwijder META');
define('_COM_SEF_IMPORT_EXPORT_META', 'Importeer/exporteer META');
define('_COM_SEF_NEW_META', 'Nieuwe META tag');
define('_COM_SEF_NEWURL_META', 'Geen-SEF URL');
define('_COM_SEF_TT_NEWURL_META', 'Vul de geen-SEF URL in voor welke u META tags wilt instellen. LET OP: Deze moet beginnen met <strong>index.php</strong>!');
define('_COM_SEF_BAD_META', 'Kijk alsublieft uw data na: sommige input is niet geldig.');
define('_COM_SEF_META_TITLE_PURGE', 'Wis META tags');
define('_COM_SEF_META_SUCCESS_PURGE', 'META tags verwijderd');
define('_COM_SEF_IMPORT_META', 'Importeer META tags');
define('_COM_SEF_EXPORT_META', 'Exporteer META tags');
define('_COM_SEF_IMPORT_META_OK', 'META tags zijn succesvol ge&iuml;mporteerd');
define('_COM_SEF_SELECT_ONE_URL', 'U dient een URL (niet meer dan 1) te selecteren.');
define('_COM_SEF_MANAGE_DUPLICATES', 'URL beheer voor : ');
define('_COM_SEF_MANAGE_DUPLICATES_RANK', 'Waardering');
define('_COM_SEF_MANAGE_DUPLICATES_BUTTON', 'Kopieer URL');
define('_COM_SEF_MANAGE_MAKE_MAIN_URL', 'Hoofd URL');
define('_COM_SEF_BAD_DUPLICATES_DATA', 'Foutmelding : ongeldige URL data');
define('_COM_SEF_BAD_DUPLICATES_NOTHING_TO_DO', 'Deze URL is hetzelfde als de hoofd URL');
define('_COM_SEF_MAKE_MAIN_URL_OK', 'Handeling succesvol uitgevoerd');
define('_COM_SEF_MAKE_MAIN_URL_ERROR', 'Er is een fout opgetreden, de handeling mislukte');
define('_COM_SEF_SH_CONTENT_TITLE', 'Inhoud instellingen');
define('_COM_SEF_SH_INSERT_CONTENT_TABLE_NAME', 'Vul inhoud tabel naam in');
define('_COM_SEF_TT_SH_INSERT_CONTENT_TABLE_NAME', 'Als u deze optie instelt op <strong>Ja</strong>, zal de menu element titel voorafgaand aan een tabel met artikelen (categorie of sectie) worden toegevoegd aan de SEF URL. Dit staat tabel weergave van blog weergaven toe.');
define('_COM_SEF_SH_CONTENT_TABLE_NAME', 'Standaard tabelnaam weergave');
define('_COM_SEF_TT_SH_CONTENT_TABLE_NAME', 'Als de vorige parameter is ingesteld op \'Ja\', kunt u de ingevoegde tekst overschrijven met deze tekst. Let op dat deze tekst niet variabel is en bijvoorbeeld niet vertaald zal worden.');
define('_COM_SEF_SH_REDIRECT_WWW', '301 doorverwijzing www/geen-www');
define('_COM_SEF_TT_SH_REDIRECT_WWW', 'Als u deze instelt op Ja, zal sh404SEF een doorverwijzing uitvoeren met een 301 foutmelding. Als de site toegankelijk is onder www, zal het doorverwezen worden als er geen www wordt ingevuld, en omgekeert. Dit zal problemen met uw Apache server configuratie en Joomla WYSIWYG editors voorkomen.');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_NAME', 'Als u deze instelt op Ja, zal de productnaam worden toegevoegd aan de URL');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU_124S', 'Voeg productcode toe');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU_124S', 'Als u deze instelt op Ja, zal de product code (SKU genoemd in Virtuemart) worden toegevoegd aan de SEF URL.');

// V 1.2.4.t
define('_COM_SEF_SH_DOCMAN_INSERT_CAT_ID', 'Voeg categorie id toe');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_CAT_ID', 'Als u deze instelt op <strong>Ja</strong>, zal de categorie id worden toegevoegd aan de SEF URL, handig voor wanneer 2 verschillende categorie&euml;n dezelfde naam hebben.');
define('_COM_SEF_SH_DOCMAN_INSERT_CATEGORIES', 'Voeg categorienaam toe');
define('_COM_SEF_TT_SH_DOCMAN_INSERT_CATEGORIES', 'Als u deze instelt op <strong>Geen</strong>, zal er geen categorienaam worden toegevoegd aan de URL, zoals bij : <br /> mijnsite.nl/joomla-cms.html<br />Als u deze instelt op <strong>Alleen laatste</strong>, zal de categorienaam worden toegevoegd aan de SEF URL, zoals in : <br /> mijnsite.nl/joomla/joomla-cms.html<br />Als u deze instelt op <strong>Alle geneste categorie&euml;n</strong>, zullen de namen van alle categorie&euml;n worden toegevoegd, zoals in : <br /> mijnsite.nl/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_FORCED_HOMEPAGE', 'Homepagina URL');
define('_COM_SEF_TT_SH_FORCED_HOMEPAGE', 'U kunt hier een gedwongen homepagina URL invullen. Dit is handig wanneer u een flash pagina, vaak een index.html bestand, wilt weergeven wanneer u naar www.mijnsite.nl gaat. Als u dit wilt, typ de volgende URL hier: www.mijnsite.nl/index.php (zonder slash /), zoadat de Joomla site wordt weergegeven wanneer u klikt op home in het hoofdmenu.');
define('_COM_SEF_SH_INSERT_CONTENT_BLOG_NAME', 'Voeg blognaam toe');
define('_COM_SEF_TT_SH_INSERT_CONTENT_BLOG_NAME', 'Als u deze instelt op Ja, zal de menu element titel dat leidt naar een blog met artikelen (categorie of sectie) worden toegevoegd aan de SEF URL. Dit staat afgezonderde tabel weergaven van blog weergaven toe.');
define('_COM_SEF_SH_CONTENT_BLOG_NAME', 'Standaard blogweergave naam');
define('_COM_SEF_TT_SH_CONTENT_BLOG_NAME', 'Wanneer de vorige parameter staat ingestelt op Ja, kunt u deze toegevoegde tekst uit de SEF URL hier overschrijven. Deze tekst is niet variabel en zal bijvoorbeeld niet vertaald worden.');
define('_COM_SEF_SH_MTREE_TITLE', 'Mosets Tree Instellingen');
define('_COM_SEF_SH_MTREE_INSERT_NAME', 'Voeg MTree naam toe');
define('_COM_SEF_TT_SH_MTREE_INSERT_NAME', 'Als u deze instelt op Ja, zal de menu element titel dat leidt naar de Mosets Tree worden toegevoegd aan de SEF URL.');
define('_COM_SEF_SH_MTREE_NAME', 'Standaard MTree naam');
define('_COM_SEF_SH_MTREE_INSERT_LISTING_ID', 'Voeg lijst ID toe');
define('_COM_SEF_TT_SH_MTREE_INSERT_LISTING_ID', 'Als u deze instelt op Ja, zal een lijst ID worden toegevoegd aan de naam, voor het geval dat twee lijsten dezelfde naam hebben.');
define('_COM_SEF_SH_MTREE_PREPEND_LISTING_ID', 'Voeg ID toe aan naam');
define('_COM_SEF_TT_SH_MTREE_PREPEND_LISTING_ID', 'Als u deze instelt op Ja, wanneer u de vorige optie ook op Ja heeft ingestelt, zal de ID worden toegevoegd aan het begin, aan de lijstnaam. Als u deze instelt op Nee, zal deze worden toegevoegd aan het einde van de SEF URL.');
define('_COM_SEF_SH_MTREE_INSERT_LISTING_NAME', 'Voeg lijstnaam toe');
define('_COM_SEF_TT_SH_MTREE_INSERT_LISTING_NAME', 'Als u deze instelt op Ja, zal de lijstnaam worden toegevoegd aan de URL die leidt tot een actie van deze lijst');

define('_COM_SEF_SH_IJOOMLA_NEWSP_TITLE', 'Nieuws Portaal Instellingen');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_NAME', 'Voeg Nieuws Portaal naam toe');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_NAME', 'Als u deze instelt op Ja, zal de menu element titel dat leidt naar iJoomla Nieuws Portaal worden toegevoegd aan de SEF URL.');
define('_COM_SEF_SH_IJOOMLA_NEWSP_NAME', 'Standaard Nieuws Portaal naam');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_CAT_ID', 'Voeg categorie ID toe');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_CAT_ID', 'Als u deze instelt op Ja, zal de categorie ID worden toegevoegd aan de naam, voor het geval dat deze dezelfde naam hebben.');
define('_COM_SEF_SH_INSERT_IJOOMLA_NEWSP_SECTION_ID', 'Voeg sectie ID toe');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_NEWSP_SECTION_ID', 'Als u deze instelt op Ja, zal de sectie ID worden toegevoegd aan de naam, voor het geval dat deze dezelfde naam hebben.');
define('_COM_SEF_SH_REMO_TITLE', 'Remository instellingen');
define('_COM_SEF_SH_REMO_INSERT_NAME', 'Voeg Remository naam toe');
define('_COM_SEF_TT_SH_REMO_INSERT_NAME', 'Als u deze instelt op Ja, zal de menu element titel die leidt tot Remository worden toegevoegd aan de SEF URL.');
define('_COM_SEF_SH_REMO_NAME', 'Standaard Remository naam');
define('_COM_SEF_SH_CB_SHORT_USER_URL', 'Verkorte URL naar gebruikersprofiel');
define('_COM_SEF_TT_SH_CB_SHORT_USER_URL', 'Als u deze instelt op Ja, zal een gebruiker de mogelijkheid krijgen om zijn/haar profiel te benaderen met een verkorte URL, gelijk aan www.mijnsite.nl/gebruikersnaam. Zorg ervoor dat dit geen conflicten oplevert met bestaande URLs, voordat u deze optie activeert.');
define('_COM_SEF_NEW_HOME_META', 'Homepagina META');
define('_COM_SEF_CONF_ERASE_HOME_META', 'Weet u zeker dat u de homepage titel en META tags wilt verwijderen?');
define('_COM_SEF_SH_UPGRADE_TITLE', 'Upgrade instellingen');
define('_COM_SEF_SH_UPGRADE_KEEP_URL', 'Behoud automatische URL');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_URL', 'Als u deze instelt op Ja, zal de SEF URL die automatisch door sh404SEF wordt gemaakt worden opgeslagen en behouden wanneer u dit component de&iuml;nstalleert. Zo kan sh404SEF deze weer terugvinden wanneer u een nieuwere versie installeert.');
define('_COM_SEF_SH_UPGRADE_KEEP_CUSTOM', 'Behoud aangepaste URLs');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_CUSTOM', 'Als u deze instelt op Ja, zal de aangepaste SEF URL die u heeft ingevoerd worden bewaard en behouden wanneer u dit component de&iuml;nstalleert. Zo kan sh404SEF deze weer terugvinden wanneer u een nieuwere versie installeert.');
define('_COM_SEF_SH_UPGRADE_KEEP_META', 'Behoud Titel en META');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_META', 'Als u deze instelt op Ja, zal de aangepaste titel en META tags worden bewaard en behouden wanneer u dit component de&iuml;nstalleert. Zo kan sh404SEF deze weer terugvinden wanneer u een nieuwere versie installeert.');
define('_COM_SEF_SH_UPGRADE_KEEP_MODULES', 'Behoud module parameters');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_MODULES', 'Als u deze instelt op <strong>Ja</strong>, worden parameters zoals positie, volgorde, titels, etc opgeslagen en behouden worden wanneer u dit component de&iuml;nstalleert. Zo kan sh404SEF deze weer terugvinden wanneer u een nieuwere versie installeert.');
define('_COM_SEF_IMPORT_OPEN_SEF','Importeer doorverwijzingen van Open SEF');
define('_COM_SEF_IMPORT_ALL','Importeer doorverwijzingen');
define('_COM_SEF_EXPORT_ALL','Exporteer doorverwijzingen');
define('_COM_SEF_IMPORT_EXPORT_CUSTOM','Importeer/Exporteer aangepaste doorverwijzingen');
define('_COM_SEF_DUPLICATE_NOT_ALLOWED', 'Deze URL bestaat reeds, terwijl u deze niet gekopieerd heeft');
define('_COM_SEF_SH_INSERT_CONTENT_MULTIPAGES_TITLE', 'Activeer slimme titels voor artikelen met meerdere pagina\'s');
define('_COM_SEF_TT_SH_INSERT_CONTENT_MULTIPAGES_TITLE', 'Als u deze instelt op Ja, zullen de artikelen met meerdere pagina\'s een andere URL krijgen. Sh404SEF zal de pagina titels toevoegen. Deze kunt u invoeren met behulp van het mospagebreak commando : {mospagebreak title=Titel_Volgende_Pagina & heading=Titel_Vorige_Pagina}, in plaats van het pagina nummer. Bijvoorbeeld, een SEF URL gelijk aan www.mijnsite.nl/gebruikers-documentatie/<strong>Pagina-2</strong>.html zal worden vervangen door www.mijnsite.nl/gebruikers-documentatie/<strong>Begin-met-sh404SEF</strong>.html.');

// v x
define('_COM_SEF_SH_UPGRADE_KEEP_CONFIG', 'Bewaar instellingen');
define('_COM_SEF_TT_SH_UPGRADE_KEEP_CONFIG', 'Als u deze instelt op Ja, zullen alle parameters van de instellingen worden opgeslagen en bewaard wanneer u het component de&iuml;nstalleerd. Zo kunt u ze terug vinden wanneer u een nieuwe versie installeert, zonder verdere actie.');
define('_COM_SEF_SH_CONF_TAB_SECURITY', 'Veiligheid');
define('_COM_SEF_SH_SECURITY_TITLE', 'Veiligheids instellingen');
define('_COM_SEF_SH_HONEYPOT_TITLE', 'Project Honey Pot instellingen');
define('_COM_SEF_SH_CONF_HONEYPOT_DOC', 'Project Honey Pot is een initiatief bedoelt om websites te beschermen tegen spam robots. Het maakt een database aan om de IP\'s van bezoekers na te kijken, tegen bekende robots. Voor het gebruik van deze database heeft u een (gratis) toegangssleutel nodig. U kunt deze krijgen <a href="http://www.projecthoneypot.org/httpbl_configure.php">van de project website</a><br />(U dient eerst een account aan te maken voordat u uw toegangssleutel kunt aanvragen - dit is ook gratis). Als u dit kunt, denk er eens over na om het project te helpen door `valkuilen` op uw webruimte te zetten, om zo te helpen met het identificeren van spam robots.');
define('_COM_SEF_SH_ACTIVATE_SECURITY', 'Activeer veiligheids functies');
define('_COM_SEF_TT_SH_ACTIVATE_SECURITY', 'Als u deze instelt op Ja, zal sh404SEF een aantal basis checks uitvoeren bij de URL\'s van uw website, om het tegen vaak voorkomende aanvallen te beschermen.');
define('_COM_SEF_SH_LOG_ATTACKS', 'Log aanvallen');
define('_COM_SEF_TT_SH_LOG_ATTACKS', 'Als u deze instelt op Ja, zullen ge&iuml;dentificeerde aanvallen worden gelogd in een tekst bestand, inclusief het IP adres van de aanvaller en het gemaakte paginaverzoek.<br />Er is 1 log bestand per maand. Deze zijn te vinden in de <site root>/administrator/com_sh404sef/logs map. U kunt deze downloaden via FTP, of een Joomla extensie gebruiken zoals Joomla Explorer om ze te bekijken. Het zijn TAB gescheiden tekst bestanden, dus uw spreadsheet software zal ze gemakkelijk kunnen openen, aangezien dit de handigste manier is om ze te bekijken.');	            
define('_COM_SEF_SH_CHECK_HONEY_POT', 'Gebruik Project Honey Pot');
define('_COM_SEF_TT_SH_CHECK_HONEY_POT', 'Als u deze instelt op Ja, worden de IP\'s van uw bezoekers nagekeken met de Project Honey Pot database, gebruikmakend van hun HTTP:BL service. Dit is gratis, maar u dient wel een toegangssleutel te verkrijgen van hun website.');
define('_COM_SEF_SH_HONEYPOT_KEY', 'Project Honey Pot toegangssleutel');
define('_COM_SEF_TT_SH_HONEYPOT_KEY', 'Als de optie Gebruik Project Honey Pot is geactiveerd, dient u een toegangssleutel te verkrijgen van P.H.P. Typ de ontvangen toegangssleutel hier. Het bevat 12 karakters.');	             
define('_COM_SEF_SH_HONEYPOT_ENTRANCE_TEXT', 'Alternatieve post tekst');
define('_COM_SEF_TT_SH_HONEYPOT_ENTRANCE_TEXT', 'Als een IP adres van een bezoeker door Project Honey Pot als verdacht wordt bevonden, zal de toegang worden geweigerd (403 code). <br />Als het een foute detectie is, zal de tekst die u hier invoert worden weergegeven aan de bezoeker, met een link waarop hij/zij dient te klikken om toegang te krijgen tot de site. Alleen een mens kan dit soort tekst lezen en begrijpen, en robots kunnen geen toegang krijgen tot deze link.<br />U kunt deze tekst naar eigen wensen aanpassen.' );	             
define('_COM_SEF_SH_SMELLYPOT_TEXT', 'Robot valkuilen tekst');
define('_COM_SEF_TT_SH_SMELLYPOT_TEXT', 'Als een spam robot ge&iuml;dentificeerd is door Project Honey Pot, en de toegang is geweigerd, zal een link worden toegevoegd onderaan het weigerings scherm, zodat Project Honey Pot kan bijhouden wat de robot doet. Er is ook een bericht toegevoegd om te voorkomen dat normale mensen op deze link klikken, in het geval dat zij verkeerd ge&iuml;dentificeerd waren.');
define('_COM_SEF_SH_ONLY_NUM_VARS', 'Numerieke parameters');
define('_COM_SEF_TT_SH_ONLY_NUM_VARS', 'Parameter namen die u in deze lijst zet zullen worden nagekeken zodat ze echt alleen numeriek zijn :  alleen getallen van 0 tot 9. Voeg 1 parameter toe per regel.');
define('_COM_SEF_SH_ONLY_ALPHA_NUM_VARS', 'Alfa-numerieke parameters');
define('_COM_SEF_TT_SH_ONLY_ALPHA_NUM_VARS', 'Parameter namen in deze lijst zullen worden nagekeken of deze alfa-numeriek zijn : getallen van 0 tot 9 en letters van a tot z. Voeg 1 parameter toe per regel.');
define('_COM_SEF_SH_NO_PROTOCOL_VARS', 'Kijk hyperlinks na in parameters');
define('_COM_SEF_TT_SH_NO_PROTOCOL_VARS', 'Parameter namen die u in deze lijst zet zullen worden nagekeken voor hyperlinks in de links, beginnend met http://, https://, ftp:// ');
define('_COM_SEF_SH_IP_WHITE_LIST', 'IP witte lijst');
define('_COM_SEF_TT_SH_IP_WHITE_LIST', 'Elke pagina die wordt bezocht door een IP adres uit deze lijst zal <stong>ge&auml;ccepteerd</strong> worden, er van uit gaand dat de URL de bovenstaande checks doorstaat. Voeg 1 IP adres toe per regel.<br />U kunt * gebruiken als asterix, zoals in : 192.168.0.*. Dit zorgt ervoor dat alle IP adressen van 192.168.0.0 tot 192.168.0.255 ge&auml;ccepteerd worden.');
define('_COM_SEF_SH_IP_BLACK_LIST', 'IP zwarte lijst');
define('_COM_SEF_TT_SH_IP_BLACK_LIST', 'Elke pagina die wordt bezocht door een IP adres van deze lijst zal de toegang worden <strong>geweigerd</strong>, er van uit gaand dat de URL de bovenstaande checks doorstaat. Voeg 1 IP adres toe per regel.<br />U kunt * gebruiken als asterix, zoals in : 192.168.0.*. Dit zorgt ervoor dat alle IP adressen van 192.168.0.0 tot 192.168.0.255 geweigerd worden.');
define('_COM_SEF_SH_UAGENT_WHITE_LIST', 'UserAgent witte lijst');
define('_COM_SEF_TT_SH_UAGENT_WHITE_LIST', 'Elk verzoek gemaakt met een UserAgent string uit deze lijst zal worden <stong>ge&auml;ccepteerd</strong>, er van uit gaand dat de URL de bovenstaande checks doorstaat. Voeg 1 UserAgent String toe per regel.');
define('_COM_SEF_SH_UAGENT_BLACK_LIST', 'UserAgent zwarte lijst');
define('_COM_SEF_TT_SH_UAGENT_BLACK_LIST', 'Elk verzoek gemaakt met een UserAgent string uit deze lijst zal worden <stong>geweigerdd</strong>, er van uit gaand dat de URL de bovenstaande checks doorstaat. Voeg 1 UserAgent String toe per regel.');
define('_COM_SEF_SH_MONTHS_TO_KEEP_LOGS', 'Aantal maanden bewaren van veiligheidslog');
define('_COM_SEF_TT_SH_MONTHS_TO_KEEP_LOGS', 'Als u het loggen van aanvallen heeft ge&auml;ctiveerd, kunt u hier instellen hoeveel maanden deze log bestanden bewaard blijven. Bijvoorbeeld, als u 1 invoert betekent dat, dat de actuele maand en de maand ervoor bewaard zal blijven. Eerdere log bestanden worden verwijderd.');
define('_COM_SEF_SH_ANTIFLOOD_TITLE', 'Anti-flood instellingen');
define('_COM_SEF_SH_ACTIVATE_ANTIFLOOD', 'Activeer anti-flood');
define('_COM_SEF_TT_SH_ACTIVATE_ANTIFLOOD', 'Als u deze ingestelt op Ja, zal sh404SEF nakijken dat elk IP adres niet te veel pagina verzoeken voor uw site doet. Door teveel verzoeken, vlak na elkaar, kan een piraat uw site onbruikbaar maken door deze te overbelasten.');
define('_COM_SEF_SH_ANTIFLOOD_ONLY_ON_POST', 'Check alleen als het data bevat (formulieren)');
define('_COM_SEF_TT_SH_ANTIFLOOD_ONLY_ON_POST', 'Als u deze instelt op Ja, zal deze controle alleen worden uitgevoerd als er om data wordt gevraagd bij het pagina verzoek. Dit is vaak het geval bij formulieren, dus kunt u de anti-flood controle alleen instellen op formulieren pagina\'s om uw site te beschermen tegen vaak voorkomende spam robots.');
define('_COM_SEF_SH_ANTIFLOOD_PERIOD', 'Anti-flood controle');
define('_COM_SEF_TT_SH_ANTIFLOOD_PERIOD', 'Tijd (in seconden) waarover het aantal verzoeken van hetzelfde IP adres worden gecontroleerd.');
define('_COM_SEF_SH_ANTIFLOOD_COUNT', 'Max aantal verzoeken');
define('_COM_SEF_TT_SH_ANTIFLOOD_COUNT', 'Aantal verzoeken dat voor geblokkeerde pagina\'s voor het aanvallende IP adres zorgt. Bijvoorbeeld, als u 10 invult als tijdsperiode, en 4 als max aantal verzoeken, zal de pagina worden geblokkeert als er meer dan 4 verzoeken in 10 seconden van dat IP adres binnenkomen. Deze blokkering geldt natuurlijk alleen voor dit IP adres, en niet voor andere bezoekers.');
define('_COM_SEF_SH_CONF_TAB_LANGUAGES', 'Talen');
define('_COM_SEF_SH_DEFAULT', 'Standaard');
define('_COM_SEF_SH_YES', 'Ja');
define('_COM_SEF_SH_NO', 'Nee');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE_PER_LANG', 'Als u deze instelt op Ja, zal de taalcode worden toegevoegd aan de URL voor <strong>deze taal</strong>. Als u deze instelt op Nee, zal de taalcode nooit worden toegevoegd. Als u deze instelt op Standaard, zal de taalcode worden toegevoegd voor alle talen, behalve voor de standaard taal van uw site.');
define('_COM_SEF_TT_SH_TRANSLATE_URL_PER_LANG', 'Als u deze instelt op Ja, en uw site is meertalig, zal uw URL <strong>in deze taal</strong> zijn volgens de Joomfish instellingen. Als u deze instelt op Nee, zal de URL nooit vertaald worden. Als u deze instelt op Standaard, zullen ze ook vertaald worden. Dit heeft geen effect op sites met maar 1 taal.');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE_GEN', 'Als u deze instelt op Ja, zal een taalcode worden toegevoegd aan de URL gemaakt door sh404SEF. U kunt het ook per taal instellen (zie hieronder).');
define('_COM_SEF_TT_SH_TRANSLATE_URL_GEN', 'Als u deze instelt op Ja, en uw site is meertalig, zal de URL worden vertaald in de taal van uw bezoekers, volgens de Joomfish instelling. Anders zal de URL in de standaard taal blijven. U kunt het ook per taal instellen (zie hieronder).');
define('_COM_SEF_SH_ADV_COMP_DEFAULT_STRING', 'Standaard naam');
define('_COM_SEF_TT_SH_ADV_COMP_DEFAULT_STRING', 'Als u hier een tekst string invult, zal deze worden toegevoegd aan het begin van alle URL\'s van dat component. Normaal gesproken niet gebruikt, alleen hier met terugwaartse kracht voor oude URL\'s van andere SEF componenten.');
define('_COM_SEF_TT_SH_NAME_BY_COMP', '. <br />U kunt hier een naam invoeren dat zal worden gebruikt in plaats van de menu element naam. Om dit te doen, dient u te gaan naar de <strong>Componenten</strong> tab. Let op dat deze tekst niet variabel zal zijn en bijvoorbeeld niet vertaald zal worden.');
define('_COM_SEF_STANDARD_ADMIN', 'Klik hier om naar de standaard weergave te gaan (met alleen hoofd parameters)');
define('_COM_SEF_ADVANCED_ADMIN', 'Klik hier om naar de geavanceerde weergave te gaan (met alle beschikbare parameters)');
define('_COM_SEF_SH_MULTIPLE_H1_TO_H2', 'Verander meerdere h1 in h2');
define('_COM_SEF_TT_SH_MULTIPLE_H1_TO_H2', 'Als u deze instelt op Ja, en er zijn verscheidene h1 tags op een pagina, zullen deze gewijzigd worden in h2 tags. <br />Als er maar 1 h1 tag op een pagina te vinden is, zal deze onaangetast blijven.');
define('_COM_SEF_SH_INSERT_NOFOLLOW_PDF_PRINT', 'Voeg nofollow tag toe aan Print en PDF links');
define('_COM_SEF_TT_SH_INSERT_NOFOLLOW_PDF_PRINT', 'Als u deze instelt op Ja, zullen rel=nofollow onderdelen worden toegevoegd aan alle PDF en Print links gemaakt door Joomla. Dit zal het aantal duplicaten van inhoud verkleinen in zoekmachines.');
define('_COM_SEF_SH_INSERT_READMORE_PAGE_TITLE', 'Voeg titel toe aan Lees meer... links');
define('_COM_SEF_TT_SH_INSERT_READMORE_PAGE_TITLE', 'Als u deze instelt op Ja en een Lees meer.. link wordt weergegeven op de pagina, zal de titel van de inhoud worden toegevoegd aan de link, voor verbetering in zoekmachines.');
define('_COM_SEF_VM_USE_ITEMS_PER_PAGE', 'Gebruik drop-down lijst voor artikelen per pagina');
define('_COM_SEF_TT_VM_USE_ITEMS_PER_PAGE', 'Als u deze instelt op <strong>Ja</strong>, zullen URL\'s worden aangepast om drop-down lijsten toe te staan. Hiermee kunnen gebruikers het aantal artikelen per pagina selecteren. Als u geen drop-down lijsten gebruikt, EN uw URL\'s zijn reeds ge&iuml;ndexeerd door zoekmachines, kunt u deze instellen op NEE om de bestaande URL\'s te behouden. ');
define('_COM_SEF_SH_CHECK_POST_DATA', 'Controleer ook de data van formulieren (verstuur)');
define('_COM_SEF_TT_SH_CHECK_POST_DATA', 'Als u deze instelt op <strong>Ja</strong>, zal de data afkomstig van invulvelden worden gecontroleerd op config variabelen of soortgelijken. Dit kan voor onnodige verstoppingen zorgen, als u bijvoorbeeld een forum heeft waar de programmering van Joomla! wordt gediscussieerd. Wanneer zij exact dezelfde strings willen bespreken, zal sh404SEF denken dat het een mogelijke aanval is. In dat geval, als u last heeft van verboden toegang foutmeldingen, kunt u deze mogelijkheid beter uitschakelen.');
define('_COM_SEF_SH_SEC_STATS_TITLE', 'Veiligheid statistieken');
define('_COM_SEF_SH_SEC_STATS_UPDATE', 'Click here to update blocked attacks counters');
define('_COM_SEF_SH_TOTAL_ATTACKS', 'Aantal aanvallen');
define('_COM_SEF_SH_TOTAL_CONFIG_VARS', 'mosConfig var in URL');
define('_COM_SEF_SH_TOTAL_BASE64', 'Base64 injectie');
define('_COM_SEF_SH_TOTAL_SCRIPTS', 'Script injectie');
define('_COM_SEF_SH_TOTAL_STANDARD_VARS', 'Illegale standaard vars');
define('_COM_SEF_SH_TOTAL_IMG_TXT_CMD', 'remote file inbegrepen');
define('_COM_SEF_SH_TOTAL_IP_DENIED', 'IP adres geweigerd');
define('_COM_SEF_SH_TOTAL_USER_AGENT_DENIED', 'UserAgent geweigerd');
define('_COM_SEF_SH_TOTAL_FLOODING', 'Te veel verzoeken (flooding)');
define('_COM_SEF_SH_TOTAL_PHP', 'Afgewezen door Project Honey Pot');
define('_COM_SEF_SH_TOTAL_PER_HOUR', ' /uur');
define('_COM_SEF_SH_SEC_DEACTIVATED', 'Tweede functies niet in gebruik');
define('_COM_SEF_SH_TOTAL_PHP_USER_CLICKED', 'PHP, maar de gebruiker klikte');
define('_COM_SEF_SH_COM_SMF_TITLE', 'SMF bridge');
define('_COM_SEF_SH_INSERT_SMF_NAME', 'Voeg forumnaam toe');
define('_COM_SEF_TT_SH_INSERT_SMF_NAME', 'Als u deze instelt op <strong>Ja</strong>, zal de menu element titel welke leidt tot de hoofdpagina van het forum worden toegevoegd aan alle forum SEF URL\'s.');
define('_COM_SEF_SH_SMF_ITEMS_PER_PAGE', 'Berichten per pagina');
define('_COM_SEF_TT_SH_SMF_ITEMS_PER_PAGE', 'Aantal berichten weergegeven op een forumpagina');
define('_COM_SEF_SH_INSERT_SMF_BOARD_ID', 'Voeg forum id toe');
define('_COM_SEF_TT_SH_INSERT_SMF_BOARD_ID', _COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME);
define('_COM_SEF_SH_INSERT_SMF_TOPIC_ID', 'Voeg topic id toe');
define('_COM_SEF_TT_SH_INSERT_SMF_TOPIC_ID', _COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID);
define('_COM_SEF_SH_INSERT_SMF_USER_NAME', 'Voeg gebruikersnaam toe');
define('_COM_SEF_TT_SH_INSERT_SMF_USER_NAME', 'Als u deze instelt op <strong>Ja</strong>, zal de gebruikersnaam worden toegevoegd aan elke URL in plaats van zijn id. Dit verbruikt ruimte in de database, omdat een unieke URL wordt gemaakt voor elke gebruiker en elke functie (bekijk profiel, pm, enz).');
define('_COM_SEF_SH_INSERT_SMF_USER_ID', 'Voeg gebruikers id toe');
define('_COM_SEF_TT_SH_INSERT_SMF_USER_ID', 'Als u deze instelt op <strong>Ja</strong>, zal een gebruikersnaam altijd worden voorafgegaan met zijn id, om er zeker van te zijn dat deze uniek is.');
define('_COM_SEF_SH_PREPEND_TO_PAGE_TITLE', 'Voeg toe voor de paginatitel'); 
define('_COM_SEF_TT_SH_PREPEND_TO_PAGE_TITLE', 'De tekst die u hier invoert wordt voor alle paginatitel tags geplaatst.'); 
define('_COM_SEF_SH_APPEND_TO_PAGE_TITLE', 'Voeg toe na de paginatitel'); 
define('_COM_SEF_TT_SH_APPEND_TO_PAGE_TITLE', 'De tekst die u hier invoert wordt na alle paginatitel tags geplaatst.');
define('_COM_SEF_SH_DEBUG_TO_LOG_FILE', 'Log debug info naar bestand');
define('_COM_SEF_TT_SH_DEBUG_TO_LOG_FILE', 'Als u deze instelt op Ja, zal sh404SEF een tekstbestand bijhouden met vele interne informatie. Deze gegevens zullen ons helpen om de problemen die u wellicht tegenkomt tijdens het gebruiken van sh404SEF op te lossen. <br/>Waarschuwing: dit bestand kan snel behoorlijk groot worden. Deze functie zal ook uw site vertragen. Wees er dus zeker van dat u deze optie alleen aanzet wanneer dit noodzakelijk is. Om deze reden zal de functie automatisch gedeactiveerd worden een uur nadat deze is gestart. Zet de optie uit, en vervolgens weer aan, om deze opnieuw te activeren. Het log bestand is te vinden in  /administrator/components/com_sh404sef/logs/ ');

define('_COM_SEF_ALIAS_LIST', 'Alias lijst');
define('_COM_SEF_TT_ALIAS_LIST', 'Vul hier een lijst van aliassen in voor deze URL. Plaats 1 alias per regel, bijvoorbeeld: <br/>oude-url.html<br/>of<br/>mijn-andere-oude-url.php?var=12&test=15<br>sh404SEF zal zorgen voor een 301 verwijzing naar de actuele SEF URL indien 1 van deze aliassen wordt opgevraagd.');
define('_COM_SEF_HOME_ALIAS', 'Hoofdpagina alias');
define('_COM_SEF_TT_HOME_PAGE_ALIAS_LIST', 'Vul hier een lijst van aliassen in voor uw hoofdpagina. Plaats 1 alias per regel, bijvoorbeeld:<br/>oude-url.html<br/>of<br/>mijn-andere-oude-url.php?var=12&test=15<br>sh404SEF zal zorgen voor een 301 verwijzing naar uw hoofdpagina indien 1 van deze aliassen wordt opgevraagd.');

define('_COM_SEF_SH_INSERT_OUTBOUND_LINKS_IMAGE', 'Voeg een symbool toe bij uitgaande links');
define('_COM_SEF_TT_SH_INSERT_OUTBOUND_LINKS_IMAGE', 'Als u deze instelt op Ja, zal er een symbool worden geplaatst naast elke link welke verwijst naar een andere website, om identificatie van deze links te vergemakkelijken.');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE_BLACK', 'Gebruik zwart symbool');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE_WHITE', 'Gebruik wit symbool');
define('_COM_SEF_SH_OUTBOUND_LINKS_IMAGE', 'Symboolkleur voor uitgaande links');
define('_COM_SEF_TT_SH_OUTBOUND_LINKS_IMAGE', 'Beide afbeeldingen hebben een transparante achtergrond. Selecteer de zwarte als uw site een lichte achtergrond heeft. Selecteer de witte als uw site een donkere achtergrond heeft. Deze afbeeldingen zijn  /administrator/components/com_sef/images/external-white.png en external-black.png. Deze zijn beiden 15x16 pixels groot.');
// V 1.3.3
define('_COM_SEF_DEFAULT_PARAMS_TITLE', 'Zeer geavanceerd');
define('_COM_SEF_DEFAULT_PARAMS_WARNING', 'WAARSCHUWING: Verander deze waarden alleen indien u weet wat u doet! Als u hier iets verkeerd invult, kunt u lastig herstelbare problemen cree&euml;n.');

// V 1.0.12
define('_COM_SEF_USE_CAT_ALIAS', 'Use category alias');
define('_COM_SEF_TT_USE_CAT_ALIAS', 'If set to <strong>Yes</strong>, sh404sef will use a category alias instead of its actual name every time that name is required to build a url');
define('_COM_SEF_USE_SEC_ALIAS', 'Use section alias');
define('_COM_SEF_TT_USE_SEC_ALIAS', 'If set to <strong>Yes</strong>, sh404sef will use a section alias instead of its actual name every time that name is required to build a url');
define('_COM_SEF_USE_MENU_ALIAS', 'Use menu alias');
define('_COM_SEF_TT_USE_MENU_ALIAS', 'If set to <strong>Yes</strong>, sh404sef will use a menu item alias instead of its actual title every time that title is required to build a url');
define('_COM_SEF_SH_ENABLE_TABLE_LESS', 'Use table-less output');
define('_COM_SEF_TT_SH_ENABLE_TABLE_LESS', 'If set to <strong>Yes</strong>, sh404sef will make Joomla use only div tags (no table tags) when outputing content, regardless of the template you are using. You should not have removed the Beez template for this to work. Beez template is installed by default with Joomla.<br /><strong>WARNING</strong> : you will have to adjust your template stylesheet to match this new html output format.');

// V 1.0.13
define( '_COM_SEF_JC_MODULE_CACHING_DISABLED', 'Caching for Joomfish language selection module has been disabled!');

// V 1.5.3
define('_COM_SEF_SH_ALWAYS_APPEND_ITEMS_PER_PAGE', 'Always append #items per page');
define('_COM_SEF_TT_SH_ALWAYS_APPEND_ITEMS_PER_PAGE', 'If set to <strong>Yes</strong>, sh404sef will always append the number of items per page to paginated urls. For instance, .../Page-2.html will become .../Page2-10.html, if the current settings cause 10 items to be displayed per page. This is required for instance if you activated drop-down lists to let your user select number of items per page.');

define('_COM_SEF_SH_REDIRECT_CORRECT_CASE_URL', '301 redirect url to correct case');
define('_COM_SEF_TT_SH_REDIRECT_CORRECT_CASE_URL', 'If set to <strong>Yes</strong>, sh404sef will perform a 301 redirect from a SEF url if it does not have the same case as an url found in the database. For instance, example.com/My-page.html will be redirected to example.com/my-page.html, if the latter is stored in the database. Conversely, example.com/my-page.html will be redirected to example.com/My-page.html if the later is the url used on your site, and therefore stored in the database.');

// V 1.5.5
define('_COM_SEF_JOOMLA_LIVE_SITE', 'Joomla live_site');
define('_COM_SEF_TT_JOOMLA_LIVE_SITE', 'You should see here the root url of your web site. For instance:<br />http://www.example.com<br/>or<br/> http://example.com<br />(no trailing slash)<br />This is not a sh404sef setting, but rather a <b>Joomla</b> setting. It is stored in Joomla\'s own configuration.php file.<br />Joomla will normally auto-detect your web site root address. However, if the address displayed here is not correct, you should set it yourself manually. This is done by modifying the content of Joomla configuration.php (usually using FTP).<br/>Symptoms linked to a bad value are : template or images do not display, buttons does not operate, all styles (colors, fonts, etc) are missing');
define('_COM_SEF_TT_JOOMLA_LIVE_SITE_MISSING', 'WARNING: $live_site missing from Joomla configuration.php file, or does not start with "http://" or "https://" !');
define('_COM_SEF_SH_JCL_INSERT_EVENT_ID', 'Insert event Id');
define('_COM_SEF_TT_SH_JCL_INSERT_EVENT_ID', 'If set to Yes, event internal id will be prepended to the event title in the urls, to make them unique');
define('_COM_SEF_SH_JCL_INSERT_CATEGORY_ID', 'Insert category id');
define('_COM_SEF_TT_SH_JCL_INSERT_CATEGORY_ID', 'If set to Yes, each event category id will be inserted in all urls to this event, in addition to the category name.');
define('_COM_SEF_SH_JCL_INSERT_CALENDAR_ID', 'Insert calendar id');
define('_COM_SEF_TT_SH_JCL_INSERT_CALENDAR_ID', 'If set to Yes, the id of the calendar to which an event belongs will be prepended to the calendar name in all urls');
define('_COM_SEF_SH_JCL_INSERT_CALENDAR_NAME', 'Insert Calendar name');
define('_COM_SEF_TT_SH_JCL_INSERT_CALENDAR_NAME', 'If set to Yes, the name of the calendar to which an event belongs will be prepended to the calendar name in all urls');
define('_COM_SEF_SH_JCL_INSERT_DATE', 'Insert date');
define('_COM_SEF_TT_SH_JCL_INSERT_DATE', 'If set to yes, the date of the target page will be inserted into each url');
define('_COM_SEF_SH_JCL_INSERT_DATE_IN_EVENT_VIEW', 'Insert date in event link');
define('_COM_SEF_TT_SH_JCL_INSERT_DATE_IN_EVENT_VIEW', 'If set to Yes, each event date will be prepended to urls to the event details page');
define('_COM_SEF_SH_JCL_TITLE', 'JCal Pro configuration');
define('_COM_SEF_SH_PAGE_TITLE_TITLE', 'Page title configuration');
define('_COM_SEF_SH_CONTENT_TITLE_TITLE', 'Joomla content page title configuration');
define('_COM_SEF_SH_CONTENT_TITLE_SHOW_SECTION', 'Insert section');
define('_COM_SEF_TT_CONTENT_TITLE_SHOW_SECTION', 'If set to Yes, an article section will be inserted in the page title of that article');
define('_COM_SEF_SH_CONTENT_TITLE_SHOW_CAT', 'Insert category');
define('_COM_SEF_TT_CONTENT_TITLE_SHOW_CAT', 'If set to Yes, an article category will be inserted in the page title of that article');
define('_COM_SEF_SH_CONTENT_TITLE_USE_ALIAS', 'Use article title alias');
define('_COM_SEF_TT_CONTENT_TITLE_USE_ALIAS', 'If set to Yes, the article alias will be used in the page title instead of the actual article title');
define('_COM_SEF_SH_CONTENT_TITLE_USE_CAT_ALIAS', 'Use category alias');
define('_COM_SEF_TT_CONTENT_TITLE_USE_CAT_ALIAS', 'If set to Yes, a category alias will be used in the page title instead of the actual category title');
define('_COM_SEF_SH_CONTENT_TITLE_USE_SEC_ALIAS', 'Use section alias');
define('_COM_SEF_TT_CONTENT_TITLE_USE_SEC_ALIAS', 'If set to Yes, a section alias will be used the page title instead of the actual section title');
define('_COM_SEF_SH_PAGE_TITLE_SEPARATOR', 'Page title separator');
define('_COM_SEF_TT_SH_PAGE_TITLE_SEPARATOR', 'Enter here a character or a string to separate the various parts of the page title, if there is more than one. Defaults to the | character, surrounded by a single space');

// V 1.5.7
define('_COM_SEF_DISPLAY_DUPLICATE_URLS_TITLE', 'Duplicates');
define('_COM_SEF_DISPLAY_DUPLICATE_URLS_NOT', 'Show only main url');
define('_COM_SEF_DISPLAY_DUPLICATE_URLS', 'Show main and duplicate urls');
define('_COM_SEF_SH_INSERT_ARTICLE_ID_TITLE', 'Insert article id in URL');
define('_COM_SEF_TT_SH_INSERT_ARTICLE_ID_TITLE', 'If set to <strong>Yes</strong>, an article internal id will be appended to the title of that article in URLs, in order to be sure each article can be accessed individually, even if 2 articles have the exact same titles, or titles that yields the same URL (after being cleaned up for invalid characters and such). This id will bring no SEO value, and you should rather make sure you do not have articles with the same title in the same section and category.<br />In case you do not control article entries, this setting may help you make sure articles can be accessed, at the cost of good search engine optimization.');

// V 1.5.8

define('_COM_SEF_SH_JS_TITLE', 'JomSocial configuration ');
define('_COM_SEF_SH_JS_INSERT_NAME', 'Insert Jomsocial name');
define('_COM_SEF_TT_SH_JS_INSERT_NAME', 'If set to <strong>Yes</strong>, the menu element title leading to JomSocial main page will be prepended to all JomSocial SEF URL');
define('_COM_SEF_SH_JS_INSERT_USER_NAME', 'Insert user short name');
define('_COM_SEF_TT_SH_JS_INSERT_USER_NAME', 'If set to <strong>Yes</strong>, user name will be inserted into SEF URLs. <strong>WARNING</strong>: this can lead to substantial increase in database size, and can slow down site, if you have many registered users.');
define('_COM_SEF_SH_JS_INSERT_USER_FULL_NAME', 'Insert user full name');
define('_COM_SEF_TT_SH_JS_INSERT_USER_FULL_NAME', 'If set to <strong>Yes</strong>, user full name will be inserted into SEF URLs. <strong>WARNING</strong>: this can lead to substantial increase in database size, and can slow down site, if you have many registered users.');
define('_COM_SEF_SH_JS_INSERT_GROUP_CATEGORY', 'Insert group category');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_CATEGORY', 'If set to <strong>Yes</strong>, a users group\'s category will be inserted into SEF URLs where the group name is used.');
define('_COM_SEF_SH_JS_INSERT_GROUP_CATEGORY_ID', 'Insert group category ID');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_CATEGORY_ID', 'If set to <strong>Yes</strong>, a users group category ID will be prepended to the category name <strong>when previous option is also set to Yes</strong>, just in case two categories have the same name.');
define('_COM_SEF_SH_JS_INSERT_GROUP_ID', 'Insert group ID');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_ID', 'If set to <strong>Yes</strong>, a users group ID will be prepended to the group name, just in case two groups have the same name.');
define('_COM_SEF_SH_JS_INSERT_GROUP_BULLETIN_ID', 'Insert group bulletin ID');
define('_COM_SEF_TT_SH_JS_INSERT_GROUP_BULLETIN_ID', 'If set to <strong>Yes</strong>, a users group bulletin ID will be prepended to the bulletin name, just in case two bulletins have the same name.');
define('_COM_SEF_SH_JS_INSERT_DISCUSSION_ID', 'Insert group discussion ID');
define('_COM_SEF_TT_SH_JS_INSERT_DISCUSSION_ID', 'If set to <strong>Yes</strong>, a users group discussion ID will be prepended to the discussion name, just in case two discussions have the same name.');
define('_COM_SEF_SH_JS_INSERT_MESSAGE_ID', 'Insert message ID');
define('_COM_SEF_TT_SH_JS_INSERT_MESSAGE_ID', 'If set to <strong>Yes</strong>, a message ID will be prepended to the message name, just in case two messages have the same subject.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ALBUM', 'Insert photo album name');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ALBUM', 'If set to <strong>Yes</strong>, the name of the album it belongs to will be inserted into SEF URLs of a photo or set of photos.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ALBUM_ID', 'Insert photo album ID');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ALBUM_ID', 'If set to <strong>Yes</strong>, an album ID will be prepended to the album name, just in case two albums have the same subject.');
define('_COM_SEF_SH_JS_INSERT_PHOTO_ID', 'Insert photo ID');
define('_COM_SEF_TT_SH_JS_INSERT_PHOTO_ID', 'If set to <strong>Yes</strong>, a photo ID will be prepended to the photo name, just in case two photos have the same subject.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_CAT', 'Insert video category name');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_CAT', 'If set to <strong>Yes</strong>, the name of the category it belongs to will be inserted into SEF URLs of a video or set of videos.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_CAT_ID', 'Insert video category ID');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_CAT_ID', 'If set to <strong>Yes</strong>, a video category ID will be prepended to the category name, just in case two categories have the same subject.');
define('_COM_SEF_SH_JS_INSERT_VIDEO_ID', 'Insert video ID');
define('_COM_SEF_TT_SH_JS_INSERT_VIDEO_ID', 'If set to <strong>Yes</strong>, a video ID will be prepended to the video name, just in case two videos have the same subject.');
define('_COM_SEF_SH_FB_INSERT_USERNAME', 'Insert user name');
define('_COM_SEF_TT_SH_FB_INSERT_USERNAME', 'If set to <strong>Yes</strong>, the username will be inserted into SEF URLs for her posts or profile.');
define('_COM_SEF_SH_FB_INSERT_USER_ID', 'Insert user ID');
define('_COM_SEF_TT_SH_FB_INSERT_USER_ID', 'If set to <strong>Yes</strong>, a user ID will be prepended  to her name, if the preceding setting is set to yes, just in case two users have the same username.');
define('_COM_SEF_SH_PAGE_NOT_FOUND_ITEMID', 'Itemid to use for 404 page');
define('_COM_SEF_TT_SH_PAGE_NOT_FOUND_ITEMID', 'The value entered here, if non zero, will be used to display the 404 page. Joomla will use the Itemid to decide which template and modules to display. Itemid represents a menu item, so you can look up Itemids in your menus list.');

//define('', '');
