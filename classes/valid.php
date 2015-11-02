<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Extended functionality for Kohana Valid
 *
 * @package    OC
 * @category   Security
 * @author     Chema <chema@open-classifieds.com>
 * @copyright  (c) 2009-2013 Open Classifieds Team
 * @license    GPL v3
 */

class Valid extends Kohana_Valid{
    
    
	/**
	* Check an email address for correct format.
	*
	* @param   string   email address
	* @param   boolean  strict RFC compatibility, valid domain with MX, and banned domains if enabled
	* @return  boolean
	*/
	public static function email($email, $strict = FALSE)
	{
		//strict validation
		if ($strict===TRUE)
		{
			//check the RFC compatibility and MX
			return (parent::email($email,TRUE))? Valid::email_domain($email):FALSE;
		}
		//just normal validation
		else
		{
			return parent::email($email);
		}
	}

    /**
     * Validate the domain of an email address by checking if the domain has a
     * valid MX record and is nmot blaklisted as a temporary email
     *
     * @link  http://php.net/checkdnsrr  not added to Windows until PHP 5.3.0
     *
     * @param   string  $email  email address
     * @return  boolean
     */
    public static function email_domain($email)
    {
        if ( ! Valid::not_empty($email))
            return FALSE; // Empty fields cause issues with checkdnsrr()

        $domain = preg_replace('/^[^@]++@/', '', $email);

        if (core::config('general.black_list') == TRUE AND in_array($domain,self::get_banned_domains()))
            return FALSE;

        // Check if the email domain has a valid MX record
        return (bool) checkdnsrr($domain, 'MX');
    }


    /**
     * gets the array of not allowed domains for emails
     * @return array 
     * @see https://github.com/ivolo/disposable-email-domains/blob/master/index.json
     * @author Chema 
     * @date 29/09/2015
     */
    public static function get_banned_domains()
    {
        return array("0-mail.com","0815.ru","0815.su","0clickemail.com","0wnd.net","0wnd.org","10mail.org","10minutemail.cf","10minutemail.com","10minutemail.de","10minutemail.ga","10minutemail.gq","10minutemail.ml","123-m.com","12minutemail.com","1ce.us","1chuan.com","1mail.ml","1pad.de","1zhuan.com","20mail.in","20mail.it","20minutemail.com","21cn.com","24hourmail.com","2prong.com","30minutemail.com","33mail.com","3d-painting.com","3mail.ga","4mail.cf","4mail.ga","4warding.com","4warding.net","4warding.org","5mail.cf","5mail.ga","60minutemail.com","675hosting.com","675hosting.net","675hosting.org","6ip.us","6mail.cf","6mail.ga","6mail.ml","6paq.com","6url.com","75hosting.com","75hosting.net","75hosting.org","7days-printing.com","7mail.ga","7mail.ml","7tags.com","8mail.cf","8mail.ga","8mail.ml","99experts.com","9mail.cf","9ox.net","a-bc.net","a45.in","abusemail.de","abyssmail.com","ac20mail.in","acentri.com","advantimo.com","afrobacon.com","ag.us.to","agedmail.com","ahk.jp","ajaxapp.net","alivance.com","amail.com","amilegit.com","amiri.net","amiriindustries.com","anappthat.com","ano-mail.net","anonbox.net","anonymail.dk","anonymbox.com","antichef.com","antichef.net","antispam.de","appixie.com","armyspy.com","asdasd.nl","aver.com","azmeil.tk","baxomale.ht.cx","beddly.com","beefmilk.com","big1.us","bigprofessor.so","bigstring.com","binkmail.com","bio-muesli.net","bladesmail.net","blogmyway.org","bobmail.info","bodhi.lawlita.com","bofthew.com","bootybay.de","boun.cr","bouncr.com","boxformail.in","boxtemp.com.br","brefmail.com","brennendesreich.de","broadbandninja.com","bsnow.net","bu.mintemail.com","buffemail.com","bugmenot.com","bumpymail.com","bund.us","bundes-li.ga","burnthespam.info","burstmail.info","buyusedlibrarybooks.org","c2.hu","cachedot.net","casualdx.com","cbair.com","ce.mintemail.com","cellurl.com","centermail.com","centermail.net","chammy.info","cheatmail.de","chogmail.com","choicemail1.com","chong-mail.com","chong-mail.net","chong-mail.org","clixser.com","cmail.com","cmail.net","cmail.org","coldemail.info","consumerriot.com","cool.fr.nf","correo.blogos.net","cosmorph.com","courriel.fr.nf","courrieltemporaire.com","crapmail.org","crazespaces.pw","crazymailing.com","cubiclink.com","curryworld.de","cust.in","cuvox.de","dacoolest.com","daintly.com","dandikmail.com","dayrep.com","dbunker.com","dcemail.com","deadaddress.com","deadchildren.org","deadfake.cf","deadfake.ga","deadfake.ml","deadfake.tk","deadspam.com","deagot.com","dealja.com","despam.it","despammed.com","devnullmail.com","dfgh.net","dharmatel.net","digitalsanctuary.com","dingbone.com","discard.cf","discard.email","discard.ga","discard.gq","discard.ml","discard.tk","discardmail.com","discardmail.de","disposable-email.ml","disposable.cf","disposable.ga","disposable.ml","disposableaddress.com","disposableemailaddresses.com","disposableemailaddresses.emailmiser.com","disposableinbox.com","dispose.it","disposeamail.com","disposemail.com","dispostable.com","divermail.com","dm.w3internet.co.uk","dodgeit.com","dodgit.com","dodgit.org","doiea.com","domozmail.com","donemail.ru","dontreg.com","dontsendmespam.de","dotmsg.com","drdrb.com","drdrb.net","droplar.com","dropmail.me","duam.net","dudmail.com","dump-email.info","dumpandjunk.com","dumpmail.de","dumpyemail.com","duskmail.com","e-mail.com","e-mail.org","e4ward.com","easytrashmail.com","ee2.pl","eelmail.com","einrot.com","einrot.de","email-fake.cf","email-fake.ga","email-fake.gq","email-fake.ml","email-fake.tk","email60.com","emailage.cf","emailage.ga","emailage.gq","emailage.ml","emailage.tk","emaildienst.de","emailgo.de","emailias.com","emailigo.de","emailinfive.com","emailisvalid.com","emaillime.com","emailmiser.com","emailproxsy.com","emails.ga","emailsensei.com","emailspam.cf","emailspam.ga","emailspam.gq","emailspam.ml","emailspam.tk","emailtemporar.ro","emailtemporario.com.br","emailthe.net","emailtmp.com","emailto.de","emailwarden.com","emailx.at.hm","emailxfer.com","emailz.cf","emailz.ga","emailz.gq","emailz.ml","emeil.in","emeil.ir","emil.com","emkei.cf","emkei.ga","emkei.gq","emkei.ml","emkei.tk","emz.net","enterto.com","ephemail.net","etranquil.com","etranquil.net","etranquil.org","evopo.com","explodemail.com","eyepaste.com","facebook-email.cf","facebook-email.ga","facebook-email.ml","facebookmail.gq","facebookmail.ml","fake-mail.cf","fake-mail.ga","fake-mail.ml","fakeinbox.cf","fakeinbox.com","fakeinbox.ga","fakeinbox.ml","fakeinbox.tk","fakeinformation.com","fakemail.fr","fakemailgenerator.com","fakemailz.com","fammix.com","fansworldwide.de","fantasymail.de","fastacura.com","fastchevy.com","fastchrysler.com","fastkawasaki.com","fastmazda.com","fastmitsubishi.com","fastnissan.com","fastsubaru.com","fastsuzuki.com","fasttoyota.com","fastyamaha.com","fatflap.com","fdfdsfds.com","fightallspam.com","fiifke.de","filzmail.com","fixmail.tk","fizmail.com","fleckens.hu","flurred.com","flyspam.com","footard.com","forgetmail.com","fornow.eu","fr33mail.info","frapmail.com","free-email.cf","free-email.ga","freemail.ms","freemails.cf","freemails.ga","freemails.ml","freundin.ru","friendlymail.co.uk","front14.org","fuckingduh.com","fudgerub.com","fux0ringduh.com","garliclife.com","gawab.com","gelitik.in","get-mail.cf","get-mail.ga","get-mail.ml","get-mail.tk","get1mail.com","get2mail.fr","getairmail.cf","getairmail.com","getairmail.ga","getairmail.gq","getairmail.ml","getairmail.tk","getmails.eu","getonemail.com","getonemail.net","ghosttexter.de","girlsundertheinfluence.com","gishpuppy.com","goemailgo.com","gorillaswithdirtyarmpits.com","gotmail.com","gotmail.net","gotmail.org","gotti.otherinbox.com","gowikibooks.com","gowikicampus.com","gowikicars.com","gowikifilms.com","gowikigames.com","gowikimusic.com","gowikinetwork.com","gowikitravel.com","gowikitv.com","grandmamail.com","grandmasmail.com","great-host.in","greensloth.com","grr.la","gsrv.co.uk","guerillamail.biz","guerillamail.com","guerillamail.net","guerillamail.org","guerrillamail.biz","guerrillamail.com","guerrillamail.de","guerrillamail.net","guerrillamail.org","guerrillamailblock.com","gustr.com","h.mintemail.com","h8s.org","hacccc.com","haltospam.com","harakirimail.com","hartbot.de","hatespam.org","hellodream.mobi","herp.in","hidemail.de","hidzz.com","hmamail.com","hochsitze.com","hopemail.biz","hot-mail.cf","hot-mail.ga","hot-mail.gq","hot-mail.ml","hot-mail.tk","hotpop.com","hulapla.de","humn.ws.gy","ieatspam.eu","ieatspam.info","ieh-mail.de","ihateyoualot.info","iheartspam.org","ikbenspamvrij.nl","imails.info","imgof.com","imstations.com","inbax.tk","inbox.si","inboxalias.com","inboxclean.com","inboxclean.org","inboxproxy.com","incognitomail.com","incognitomail.net","incognitomail.org","insorg-mail.info","instant-mail.de","instantemailaddress.com","ipoo.org","irish2me.com","iroid.com","iwi.net","jetable.com","jetable.fr.nf","jetable.net","jetable.org","jnxjn.com","jobbikszimpatizans.hu","jourrapide.com","jsrsolutions.com","junk1e.com","junkmail.ga","junkmail.gq","kasmail.com","kaspop.com","keepmymail.com","killmail.com","killmail.net","kimsdisk.com","kingsq.ga","kir.ch.tc","klassmaster.com","klassmaster.net","klzlk.com","kook.ml","koszmail.pl","kulturbetrieb.info","kurzepost.de","l33r.eu","labetteraverouge.at","lackmail.net","lags.us","landmail.co","lastmail.co","lastmail.com","lazyinbox.com","letthemeatspam.com","lhsdv.com","lifebyfood.com","link2mail.net","litedrop.com","loadby.us","login-email.cf","login-email.ga","login-email.ml","login-email.tk","lol.ovpn.to","lookugly.com","lopl.co.cc","lortemail.dk","lovemeleaveme.com","lr7.us","lr78.com","lroid.com","luv2.us","m4ilweb.info","maboard.com","mail-filter.com","mail-temporaire.fr","mail.by","mail.mezimages.net","mail114.net","mail2rss.org","mail333.com","mail4trash.com","mailbidon.com","mailblocks.com","mailbucket.org","mailcat.biz","mailcatch.com","maildrop.cc","maildrop.cf","maildrop.ga","maildrop.gq","maildrop.ml","maildx.com","maileater.com","mailexpire.com","mailfa.tk","mailforspam.com","mailfree.ga","mailfree.gq","mailfree.ml","mailfreeonline.com","mailfs.com","mailguard.me","mailimate.com","mailin8r.com","mailinater.com","mailinator.com","mailinator.gq","mailinator.net","mailinator.org","mailinator.us","mailinator2.com","mailincubator.com","mailismagic.com","mailjunk.cf","mailjunk.ga","mailjunk.gq","mailjunk.ml","mailjunk.tk","mailmate.com","mailme.gq","mailme.ir","mailme.lv","mailme24.com","mailmetrash.com","mailmoat.com","mailnator.com","mailnesia.com","mailnull.com","mailpick.biz","mailproxsy.com","mailquack.com","mailrock.biz","mailsac.com","mailscrap.com","mailseal.de","mailshell.com","mailsiphon.com","mailslapping.com","mailslite.com","mailtemp.info","mailtothis.com","mailzilla.com","mailzilla.org","mailzilla.orgmbx.cc","makemetheking.com","manifestgenerator.com","manybrain.com","mbx.cc","mciek.com","mega.zik.dj","meinspamschutz.de","meltmail.com","messagebeamer.de","mezimages.net","mfsa.ru","mierdamail.com","migumail.com","mintemail.com","mjukglass.nu","moakt.com","mobi.web.id","mobileninja.co.uk","moburl.com","mohmal.com","moncourrier.fr.nf","monemail.fr.nf","monmail.fr.nf","monumentmail.com","ms9.mailslite.com","msa.minsmail.com","mt2009.com","mt2014.com","mx0.wwwnew.eu","my10minutemail.com","mycleaninbox.net","myemailboxy.com","mymail-in.net","mymailoasis.com","mynetstore.de","mypacks.net","mypartyclip.de","myphantomemail.com","myspaceinc.com","myspaceinc.net","myspaceinc.org","myspacepimpedup.com","myspamless.com","mytemp.email","mytempemail.com","mytrashmail.com","neomailbox.com","nepwk.com","nervmich.net","nervtmich.net","netmails.com","netmails.net","netzidiot.de","neverbox.com","nice-4u.com","nmail.cf","no-spam.ws","nobulk.com","noclickemail.com","nogmailspam.info","nomail.xl.cx","nomail2me.com","nomorespamemails.com","nonspam.eu","nonspammer.de","noref.in","nospam.wins.com.br","nospam.ze.tc","nospam4.us","nospamfor.us","nospamthanks.info","notmailinator.com","notsharingmy.info","nowhere.org","nowmymail.com","ntlhelp.net","nurfuerspam.de","nus.edu.sg","nwldx.com","objectmail.com","obobbo.com","odaymail.com","one-time.email","oneoffemail.com","oneoffmail.com","onewaymail.com","online.ms","oopi.org","opayq.com","ordinaryamerican.net","otherinbox.com","ourklips.com","outlawspam.com","ovpn.to","owlpic.com","pancakemail.com","paplease.com","pcusers.otherinbox.com","pepbot.com","pfui.ru","pimpedupmyspace.com","pjjkp.com","plexolan.de","poczta.onet.pl","politikerclub.de","poofy.org","pookmail.com","postacin.com","privacy.net","privy-mail.com","privymail.de","proxymail.eu","prtnx.com","prtz.eu","punkass.com","putthisinyourspamdatabase.com","pwrby.com","qasti.com","qisdo.com","qisoa.com","quickinbox.com","quickmail.nl","radiku.ye.vc","rcpt.at","reallymymail.com","receiveee.chickenkiller.com","receiveee.com","recode.me","reconmail.com","recursor.net","recyclemail.dk","regbypass.com","regbypass.comsafe-mail.net","rejectmail.com","remail.cf","remail.ga","rhyta.com","rk9.chickenkiller.com","rklips.com","rmqkr.net","royal.net","rppkn.com","rtrtr.com","ruffrey.com","s0ny.net","safe-mail.net","safersignup.de","safetymail.info","safetypost.de","sandelf.de","saynotospams.com","scatmail.com","schafmail.de","selfdestructingmail.com","selfdestructingmail.org","sendspamhere.com","sharedmailbox.org","sharklasers.com","shieldedmail.com","shiftmail.com","shitmail.me","shitmail.org","shitware.nl","shortmail.net","showslow.de","sibmail.com","sinnlos-mail.de","siteposter.net","skeefmail.com","slaskpost.se","slave-auctions.net","slopsbox.com","slushmail.com","smashmail.de","smellfear.com","smellrear.com","snakemail.com","sneakemail.com","snkmail.com","sofimail.com","sofort-mail.de","softpls.asia","sogetthis.com","sohu.com","soisz.com","solvemail.info","soodomail.com","soodonims.com","spam-be-gone.com","spam.la","spam.su","spam4.me","spamavert.com","spambob.com","spambob.net","spambob.org","spambog.com","spambog.de","spambog.net","spambog.ru","spambooger.com","spambox.info","spambox.irishspringrealty.com","spambox.us","spamcannon.com","spamcannon.net","spamcero.com","spamcon.org","spamcorptastic.com","spamcowboy.com","spamcowboy.net","spamcowboy.org","spamday.com","spamdecoy.net","spamex.com","spamfighter.cf","spamfighter.ga","spamfighter.gq","spamfighter.ml","spamfighter.tk","spamfree.eu","spamfree24.com","spamfree24.de","spamfree24.eu","spamfree24.info","spamfree24.net","spamfree24.org","spamgoes.in","spamgourmet.com","spamgourmet.net","spamgourmet.org","spamherelots.com","spamhereplease.com","spamhole.com","spamify.com","spaminator.de","spamkill.info","spaml.com","spaml.de","spammotel.com","spamobox.com","spamoff.de","spamsalad.in","spamslicer.com","spamspot.com","spamstack.net","spamthis.co.uk","spamthisplease.com","spamtrail.com","spamtroll.net","speed.1s.fr","spikio.com","spoofmail.de","squizzy.de","ssoia.com","startkeys.com","stinkefinger.net","stop-my-spam.cf","stop-my-spam.com","stop-my-spam.ga","stop-my-spam.ml","stop-my-spam.tk","streetwisemail.com","stuffmail.de","supergreatmail.com","supermailer.jp","superrito.com","superstachel.de","suremail.info","svk.jp","sweetxxx.de","tafmail.com","tagyourself.com","talkinator.com","tapchicuoihoi.com","teewars.org","teleworm.com","teleworm.us","temp.emeraldwebmail.com","temp.headstrong.de","tempalias.com","tempe-mail.com","tempemail.biz","tempemail.co.za","tempemail.com","tempemail.net","tempinbox.co.uk","tempinbox.com","tempmail.it","tempmail2.com","tempmaildemo.com","tempmailer.com","tempomail.fr","temporarily.de","temporarioemail.com.br","temporaryemail.net","temporaryemail.us","temporaryforwarding.com","temporaryinbox.com","tempsky.com","tempthe.net","tempymail.com","thanksnospam.info","thankyou2010.com","thecloudindex.com","thisisnotmyrealemail.com","throam.com","throwawayemailaddress.com","throwawaymail.com","tilien.com","tittbit.in","tmail.ws","tmailinator.com","toiea.com","toomail.biz","tradermail.info","trash-amil.com","trash-mail.at","trash-mail.cf","trash-mail.com","trash-mail.de","trash-mail.ga","trash-mail.gq","trash-mail.ml","trash-mail.tk","trash2009.com","trash2010.com","trash2011.com","trashdevil.com","trashdevil.de","trashemail.de","trashmail.at","trashmail.com","trashmail.de","trashmail.me","trashmail.net","trashmail.org","trashmail.ws","trashmailer.com","trashymail.com","trashymail.net","trayna.com","trbvm.com","trickmail.net","trillianpro.com","tryalert.com","turual.com","twinmail.de","twoweirdtricks.com","tyldd.com","ubismail.net","uggsrock.com","umail.net","unmail.ru","upliftnow.com","uplipht.com","uroid.com","username.e4ward.com","valemail.net","venompen.com","veryrealemail.com","vidchart.com","viditag.com","viewcastmedia.com","viewcastmedia.net","viewcastmedia.org","vomoto.com","vubby.com","walala.org","walkmail.net","webemail.me","webm4il.info","webuser.in","wee.my","weg-werf-email.de","wegwerf-email-addressen.de","wegwerf-emails.de","wegwerfadresse.de","wegwerfemail.de","wegwerfmail.de","wegwerfmail.info","wegwerfmail.net","wegwerfmail.org","wegwerpmailadres.nl","wetrainbayarea.com","wetrainbayarea.org","wh4f.org","whatiaas.com","whatpaas.com","whatsaas.com","whopy.com","whtjddn.33mail.com","whyspam.me","wickmail.net","wilemail.com","willselfdestruct.com","winemaven.info","wmail.cf","wollan.info","wronghead.com","wuzup.net","wuzupmail.net","www.e4ward.com","www.gishpuppy.com","www.mailinator.com","wwwnew.eu","xagloo.com","xemaps.com","xents.com","xmaily.com","xoxox.cc","xoxy.net","xyzfree.net","yapped.net","yeah.net","yep.it","yert.ye.vc","yogamaven.com","yomail.info","yopmail.com","yopmail.fr","yopmail.gq","yopmail.net","youmail.ga","ypmail.webarnak.fr.eu.org","yuurok.com","za.com","zehnminutenmail.de","zetmail.com","zippymail.info","zoaxe.com","zoemail.com","zoemail.net","zoemail.org","zomg.info","zxcv.com","zxcvbnm.com","zzz.com");
    }

    /**
     * Checks whether a string is a valid price (negative and decimal numbers allowed).
     *
     * Uses {@link http://www.php.net/manual/en/function.localeconv.php locale conversion}
     * to allow decimal point to be locale specific.
     *
     * @param   string  $str    input string
     * @return  boolean
     */
    public static function price($str)
    {
        // Get the decimal point for the current locale
        list($decimal) = array_values(localeconv());

        // A lookahead is used to make sure the string contains at least one digit (before or after the decimal point)
        $result = (bool) preg_match('/^-?+(?=.*[0-9])[0-9]*+'.preg_quote($decimal).'?+[0-9]*+$/D', (string) $str);

        //failsafe using as decimal de '.'
        if ($result===FALSE)
            $result = (bool) preg_match('/^-?+(?=.*[0-9])[0-9]*+.?+[0-9]*+$/D', (string) $str);
        

        return $result;
    }
}
