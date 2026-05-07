

<?php 
$class=$_GET['class_name'];

if ($class==1)// this condition checks which class u have select and you can add subject according to class 1
	{
    $subject_name=["English","English","Mathematics","Mathematics","Mathematics","Hindi","Urdu"];
	$book_code=["aeen1=10","aerd1=19","aemh1=13","ahmh1=13","auri1=13","ahhn1=23","aulb1=27"];
	$book_name=["Marigold","Raindrops","Math-Magic","Ganit Ka Jaadu","Riyazi Ka Jadoo-I(Urdu)","Rimjhim","Ibtedai Urdu-I"];
	 $total=count($book_code);
	 }elseif($class==2){
	$subject_name=["Mathematics","Mathematics","Mathematics","Hindi","English","English","Urdu"];
	$book_code=["bemh1=15","bhmh1=15","buri1=15","bhhn1=15","been1=10","berd1=10","buib1=20"];
	$book_name=["Math-Magic","ganit ka Jadu","Riyazi ka Jadu-II(Urdu)","Rimjhim","Marigold","Raindrops","Ibtedai Urdu-II"];
	 $total=count($book_code);
	 }
	 elseif($class==3){
	$subject_name=["Hindi","Environmental Studies","Environmental Studies","Environmental Studies","English","Mathematics","Mathematics","Mathematics","Urdu"];
	$book_code=["chhn1=15","ceap1=24","chap1=24","cuap1=24","ceen1=10","cemh1=14","chmh1=14","curi1=14","culb1=20"];
	$book_name=["Rimjhim","Looking Around","Aas-Pass","Aas-Pass(urdu)","Marigold","Mathematics","Ganit","Riyazi Ka Jadoo-III(Urdu)","Ibtedai Urdu"];
	 $total=count($book_code);
	 }
	 elseif($class==4){
	$subject_name=["Mathematics","Mathematics","Mathematics","Hindi","Environmental Studies","Environmental Studies","Environmental Studies","English","Urdu"];
	$book_code=["demh1=14","dhmh1=14","duri1=14","dhhn1=14","deap1=27","dhap1=27","duap1=27","deen1=10","dulb1=22"];
	$book_name=["Math-Magic","Ganit Ka Jadu","Riyazi Ka Jadu(Urdu)","Rimjhim","Looking Around(EVS)","Aas Paas","Aas-Paas(Urdu)","Marigold","Ibtedai Urdu-IV"];
	 $total=count($book_code);
	 }
	 elseif($class==5){
     $subject_name=["Mathematics","Mathematics","Mathematics","Hindi","English","Environmental Studies", "Environmental Studies","Environmental Studies","Urdu","Urdu","Urdu"];
	 $book_code=["eemh1=14","ehmh1=14","euma1=14","ehhn1=18","eeen1=10","ehap1=22","eeap1=22","euev1=22","eulb1=22","euma1=14","euev1=22"];
	 $book_name=["Math-Magic","Ganit","Riyazi Ka Jadoo(Urdu)","Rimjhim","Marigold","Aas-Pass","Looking Around","Ass Pass(Urdu)","Ibtedai Urdu Class-V","math-magic-V","EVS-V (Urdu)"];
	 $total=count($book_code);
	 }
	 elseif($class==6){
	$subject_name=["Hindi","Hindi","Hindi","English","English","Mathematics","Mathematics","Mathematics","Mathematics","Social Studies","Social Studies","Social Studies","Social Studies","Social Studies","Social Studies","Social Studies","Social Studies","Social Studies","Sanskrit","Science","Science","Science","Urdu","Urdu"];
	$book_code=["fhvs1=17","fhdv1=28","fhbr1=12","fehl1=10","fepw1=10","femh1=14","fhmh1=14","furi1=14","feep1=9","fess1=12","fess2=8","fhss1=12","fess3=9","fhss3=9","fhss2=8","fuhm1=12","fuzm1=8","fuss1=9","fhsk1=15","fhsc1=16","fesc1=16","fuse1=16","fuug1=10","fujp1=32"];
	$book_name=["Vasant","Durva","Bal Ram Katha","Honeysuckle","A Pact With The Sun","Mathematics","Ganit","Hisab(Urdu)","Exemplar Problem(English)","History - Our Past","The Earth Our Habitat","Hamare Ateet","Social And Political Life","Samajik Evem Rajnitik Jeevan","Prithavi Hamara Avas (Bhugol)","Hamare Maazi(Urdu)","Zameen Hamara Maskan(Urdu)","Samazi Aur Siyasi Zindagi(Urdu)","Ruchira","Vigyan","Science","science-VI(Urdu)","Urdu Guldasta","Jaan Pahechan"];

	 $total=count($book_code);
	 }
	 elseif($class==7){
    $subject_name=["Mathematics","Mathematics","Mathematics","Science","Science","Science","English","English","Sanskrit","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Hindi","Hindi","Hindi","Urdu","Urdu","Urdu"];
	$book_code=["ghmh1=15","gemh1=15","guma1=15","gesc1=19","ghsc1=18","guse1=18","gehc1=10","geah1=10","ghsk1=15","gess3=10","ghss3=10","guss3=10","gess1=10","ghss1=10","gess2=10","ghss2=10","guhm1=10","guha1=5","ghvs1=20","ghdv1=18","ghmb1=1","guaz1=21","gugu1=15","gudp1=26"];
	$book_name=["Ganit","Mathmatics","Hisab(Urdu)","Science","Vigyan","Science(Urdu)","Honeycomb","An alien Hand Supplementry Reader","Ruchira","Social and Political Life","Samajik aur Rajniti Jeevan","Samajik Aur Siyasi Zindagi","Our Pasts-II","Hamare Ateet-II","Our Environment","Hamara Paryavaran","Hamare Maazi(Urdu)","Hamare Mahol(Urdu)","Vasant","Durva","Mahabharat","Apni Zaban","Urdu Guldasta-Suppl","Door - Pass"];

	 $total=count($book_code);
	 }
	 elseif($class==8){
	$subject_name=["English","English","Mathematics","Mathematics","Mathematics","Sanskrit","Hindi","Hindi","Hindi","Science","Science","Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Urdu","Urdu","Urdu","Urdu"];
	$book_code=["hehd1=10","heih1=10","hemh1=16","hhmh1=16","huhi1=16","hhsk1=15","hhvs1=18","hhdv1=19","hhbk1=9","hesc1=18","hhsc1=18","huse1=18","hess4=6","hhss4=6","hess3=10","hhss3=10","hess1=6","hhss1=6","hess2=6","hhss2=6","hugy1=6","huss1=10","huhm1=6","huhm2=6","huaz1=22","huug1=9","hudp1=20","hujp1=26"];
	$book_name=["Honeydew","It So Happend","Mathematics","Ganit","Riyazi(Urdu)","Ruchira","Vasant","Durva","Bharat Ki Khoj","Science","Vigyan","Science(Urdu)","Resource And Development(Geography)","Sansadhan Avam Vikas(Bhugol)","Social And Political Life","Samajik Avam Rajnatik Jeevan","Our-Pasts-III (Part-I)","Hamare Atit-III (Itihas)","Our-Pasts-III (Part-II)","Hamare Atit-III (Bhag-II)","Geography(Urdu)","Samaji Aur Siyasi Zindagi(Urdu)","Hamare Maazi Part-I (Urdu)","Hamare Maazi Part-II(Urdu)","Apni Zaban","Urdu Guldasta (Supl)","Door-Pass","Jaan Pahechan"];
	
	$total=count($book_code);
	}
	elseif($class==9){
	$subject_name=["English","English","Hindi","Hindi","Hindi","Hindi","Sanskrit","Sanskrit","Mathematics","Mathematics","Mathematics","Science","Science","Science","Urdu","Urdu","Urdu","Urdu","Urdu","Urdu","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Health and Physical Education"];
	$book_code=["iebe1=11","iemo1=10","ihks1=17","ihsp1=16","ihkr1=5","ihsa1=6","ihsh1=12","jhva1=14","iemh1=15","ihmh1=15","iumh1=15","iesc1=15","ihsc1=15","iusc1=14","iugu1=10","iuna1=23","iujp1=23","iudp1=23","iusr1=23","iuau1=23","iess4=6","ihss4=6","iess1=6","ihss1=6","ihss2=4","iess2=4","iess3=8","ihss3=8","iuge1=6","iuss4=6","iuhi1=8","iuss1=6","iuss2=4","iehp1=14"];
	$book_name=["Beehive English Text Book","Moments Supplimentary Reader","Kshitij Hindi Text Book","Sprash","Kritika","Sanchayan","Shemushi Prathmo Bhag","Vyakaranavithi","Mathematics","Ganit","Reyazi (Urdu)","Science","Vigyan","Science (Urdu)","Gulzare-e-urdu","Nawa-e-urdu","Jaan Pahechan","Door Pass","Sab Rang","Asnaf-e-Urdu Adab","Democratic Politics","Loktantrik Rajniti","Contemporary India","Samkalin Bharat","Arthashastra","Economics","India and the Contempoarary World-I","Bharat Aur Samkalin Vishwa-I","Geographia(Urdu)","Jamhuri Syasat(Urdu)","Hindustan Aur Asri Dunia-I(Urdu)","Aasri Hindustan","Mashiyat","Health and Physical Education"];
	
    $total=count($book_code);
	}
	elseif($class==10){
	$subject_name=["Mathematics","Mathematics","Science","Science","Hindi","Hindi","Hindi","Hindi","English","English","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Social Science","Sanskrit","Sanskrit","Urdu","Urdu","Urdu","Urdu","Urdu","Urdu"];
	$book_code=["jemh1=15","jhmh1=15","jesc1=16","jhsc1=16","jhks1=17","jhsp1=17","jhsy1=3","jhkr1=5","jeff1=11","jefp1=10","jess1=7","jhss1=7","jess2=5","jhss2=5","jess3=8","jhss3=8","jess4=8","jhss4=8","jhsk1=12","jhva1=14","juge1=12","june1=11","juuq1=22","jujp1=22","judp1=19","jusr1=9"];
	$book_name=["Mathematics","Ganit","Science","Vigyan","Kshitij-2","Sparsh","Sanchayan Bhag-2","Kritika","First Flight","Foot Prints Without feet Supp. Reader","Contemporary India","Samkalin Bharat","Understanding Economic Development","Arthik Vikas ki Samajh","India and the Contemporary World-II","Bharat Aur Samakalin Vishav-2","Democratic Politics","Loktantrik Rajniti","Shemushi","Vyakaranavithi","Gulzar-e-Urdu","Nawa-e-Urdu","Urdu Qwaid aur Insha","Jaan Pahechan","Door-Paas","Sab Rang"];
	$total=count($book_code);
	}
	elseif($class==11){
	$subject_name=["Sanskrit","Sanskrit","Accountancy","Accountancy","Accountancy","Accountancy","Accountancy","Accountancy","Business Studies","Business Studies","Business Studies","Chemistry","Chemistry","Chemistry","Chemistry","Chemistry","Chemistry","Mathematics","Mathematics","Mathematics","Statistics","Statistics","Biology","Biology","Biology","Biology","Biology","Biology","Home Science","Home Science","Psychology","Psychology","Psychology","Economics","Economics","Economics","Economics","Geography","Geography","Geography","Geography","Geography","Geography","Geography","Geography","Geography","Geography","Physics","Physics","Physics","Physics","Physics","Physics","Hindi","Hindi","Hindi","Hindi","Sociology","Sociology","Sociology","Sociology","Sociology","Sociology","English","English","English","Political Science","Political Science","Political Science","Political Science","Political Science","Political Science","Political Science","History","History","History","Heritage Crafts","Heritage Crafts","Graphics design","Computers and Communication Technology","Computers and Communication Technology","Computers and Communication Technology","Computers and Communication Technology","Fine Art","Urdu","Urdu","Creative Writing and Translation"];
	$book_code=["khsk1=10","khsk2=12","keac1=8","khac1=8","keac2=6","khac2=6","kuac1=8","kuac2=7","kebs1=12","khbs1=12","kubs1=12","kech1=7","khch1=7","kuch1=7","kech2=7","khch2=7","kuch2=7","kemh1=16","khmh1=16","kumh1=16","kest1=9","khst1=9","kebo1=22","khbo1=22","kubo1=10","kubo2=12","kehe1=2","kehe2=2","kehe1=2","kehe2=2","kepy1=9","khpy1=9","kupy1=9","keec1=10","khec1=10","kuec1=10","kusc1=9","kegy2=16","khgy2=16","kugy2=17","kugy1=7","kugy1=7","kegy3=8","khgy3=8","kegy1=7","khgy1=7","kugy3=8","keph1=8","khph1=8","kuph1=8","keph2=7","khph2=7","kuph2=7","khat1=19","khar1=20","khvt1=3","khan1=3","kesy1=5","khsy1=5","kusy1=5","kesy2=5","khsy2=5","kusy2=5","keww1=27","kehb1=14","kesp1=8","keps1=10","khps1=10","kups1=10","kuec1=10","keps2=10","khps2=10","kups2=10","kehs1=4","khhs1=11","kuta1=11","kehc1=10","kuhc1=10","kegd1=8","kect1=8","kect2=6","khct1=8","khct2=6","kefa1=8","kuna1=20","kudh1=27","khsr1=4"];
	$book_name=["Bhaswati","Shashwati","Financial Accounting-I","Lekhashastra-I","Accountancy-II","Lekhashastra-II","Khatadari-I(Urdu)","Khatadari-II(Urdu)","Business Studies","Vyavsay Adhyanan","Karobari Uloom I","Chemistry Part-I","Rasayan Vigyan bhag-I","Keemiya I","Chemistry Part II","Rasayan Vigyan bhag-II","Keemiya II","Mathematics","Ganit","Riyazi I","Statistics for Economics","Sankhyiki","Biology","Jeev Vigyan","Hayatiyaat I","Hayatiyaat II","Human Ecology and Family Sciences Part I","Human Ecology and Family Sciences Part II","Human Ecology and Family Sciences Part I","Human Ecology and Family Sciences Part II","Introduction to Psychology","Manovigyan","Nafsiyaat","Indian Economic Development","Bhartiya Airthryavstha Ka Vikas","Hindustan Ki Moaashi Tarraqqi(Urdu)","Shumariyaat Bar-e-Mushiyat(Urdu)","Fundamental of Physical Geography","Bhautique Bhugol ke Mool Sidhant","Tabai Gugraphiya ke Mubadiyat","Hindustan Tabiee Mahol (Urdu)","Geographia mein amli kaam (Urdu)","Pratical Work in Geography","Bhugol Main Prayogatmak Karya","India Physical Environment","Bhart Bhautik Paryabaran","Jughrafia Mein Aamli Kam","Physics Part-I","Bhautiki-I","Tabiyaat-I","Physics Part-II","Bhautiki-II","Tabiyaat-II","Antra","Aroh","Vitan","Antral","Introducing Sociology","Samajshastra-I","Samajiyaat Ka Tarf","Understanding Society","Samaj ka Bodh","Mutala-e-Muashira","Woven Words","Hornbill","Snapshots Suppl.Reader English","Political Theory","Raajneeti Sidhant","Hindustani Aain aur Kaam","Indian Economic Development(Urdu)","India Constitution at Work","Bharat ka Samvidhan Sidhant aur Vyavhar","Siyasi Nazaria","Themes in World History","Vishwa Itihas Ke Kuch Vishay","Tareekh-e-Alam per Mabni Mauzuaat Part I","Living Craft Traditions of India","Hindustan me Dastkari Ki Riwayat","The story of graphic design","CCT Part-I","CCT Part-II","Computer aur Sanchar Prodhogiki Part-I","Computer aur Sanchar Prodhogiki Part-II","An Introduction to Indian Art Part-I","Nai Awaz","Dhanak","Srijan"];
	
	$total=count($book_code);
	}
	elseif($class==12){
	$subject_name=["Accountancy","Accountancy","Accountancy","Accountancy","Accountancy","Mathematics","Mathematics","Mathematics","Mathematics","Physics","Physics","Physics","Physics","Hindi","Hindi","Hindi","Hindi","English","English","English","Biology","Biology","Biology","History","History","History","History","History","History","Geography","Geography","Geography","Geography","Geography","Geography","Psychology","Psychology","Sociology","Sociology","Sociology","Sociology","Chemistry","Chemistry","Chemistry","Chemistry","Sanskrit","Sanskrit","Political Science","Political Science","Political Science","Political Science","Home Science","Home Science","Economics","Economics","Economics","Economics","Business Studies","Business Studies","Business Studies","Business Studies","Urdu","Urdu","Urdu","Urdu","Heritage Crafts","Heritage Crafts","New Age Graphics Design"];
	$book_code=["leac1=5","leac2=6","lhac1=5","lhac2=6","leca1=6","lemh1=6","lemh2=6","lhmh1=6","lhmh2=7","leph1=8","leph2=7","lhph1=8","lhph2=7","lhat1=21","lhar1=18","lhvt1=4","lhan1=4","lekl1=21","lefl1=14","levt1=8","lebo1=16","lhbo1=16","lehe1=10","lehs1=4","lhhs1=4","lehs2=5","lhhs2=5","lehs3=6","lhhs3=6","legy1=10","legy3=6","lhgy1=10","lhgy3=6","legy2=12","lhgy2=12","lepy1=9","lhpy1=9","lesy1=7","lhsy1=7","lesy2=8","lhsy2=8","lech1=9","lech2=7","lhch1=9","lhch2=7","lhsk1=10","lhsk2=12","leps1=9","lhps1=9","leps2=9","lhps2=9","lehe1=10","lehe2=15","leec2=6","leec1=6","lhec2=6","lhec1=6","lebs1=8","lhbs1=8","lebs2=5","lhbs2=4","luga1=17","luku1=6","luna1=16","ludh1=11","lehc1=9","lhhc1=9","legd1=12"];
    $book_name=["Accountancy-I","Accountancy Part-II","Lekhashastra Part-I","Lekhashastra Part-II","Computerised Accounting System","Mathematics Part-I","Mathematics Part-II","Ganit-I","Ganit-II","Physics Part-I","Physics Part-II","Bhautiki-I","Bhautiki-II","Antra","Aroh","Vitan","Antral Bhag 2","Kaliedoscope","Flamingo","Vistas","Biology","Jeev Vigyan","Human Ecology and Family Sciences Part I","Themes in Indian History-I","Bharatiya Itihas ke kuchh Vishay-I","Themes in Indian History-II","Bharatiya Itihas ke kuchh Vishay-II","Themes in Indian History-III","Bharatiya Itihas ke kuchh Vishay-III","Fundamentals of Human Geography","Practical Work in Geography Part II","Manav Bhugol Ke Mool Sidhant","Bhogol main peryojnatmak karye","India -People And Economy","Bharat log aur arthvyasastha(Bhugol)","Psychology","Manovigyan","Indian Society","Bhartiya Samaj","Social Change and Development in India","Bharat main Samajik Parivartan aur Vikas","Chemistry-I","Chemistry-II","Rasayan vigyan bhag I","Rasayan vigyan bhag II","Bhaswati","Shaswati","Contemporary World Politics","Samkalin Vishwa Rajniti","Political Science-II","Swatantra Bharat Mein Rajniti-II","Human Ecology and Family Sciences Part I","Human Ecology and Family Sciences Part II","Introductory Microeconomics","Introductory Macroeconomics","Vyashthi Arthshasrta","Samashty Arthshastra Ek Parichay","Bussiness Studies-I","Vyavasai Adhyan-I","Bussiness Studies-II","Vyavasai Adhyan-II","Gulistan-e- Adab","Khayaban-e-Urdu","Nai Awaz","Dhanak","Craft Tradition of India","Bharatiya Hastkla Ki Paramparayen","New Age Graphics Design"];
	$total=count($book_code);
	}
	elseif($class==13&&14){
	$subject_name=["Hindi","Sanskrit","Heritage Crafts","Heritage Crafts"];
	$book_code=["kham1=16","klss1=12","kehc1=10","khhc1=10"];
	$book_name=["Abhivyakti Aur Madhyam","Sanskrit Sahitya parichay","Exploring Craft Tradition of India","Bhartiya Hastkala Parmparaon ki Khoj"];
	$total=count($book_code);
	}
	?>
		 	 <tr  style="height:50px; background-image: url('images/bookshelf_empty_tr1.png');">

			  <td></td>
			  <td></td>
			  <td></td>
			  <td></td>

			 </tr>
		  <tr style="height:250px;  background-image: url('images/bookshelf_empty_tr.png');">
			 
			  <?php
			  	$total_td=0;
			  if($total<4){
			  $total_td=4-$total;
			  }
	 for($i=0;$i<$total;$i++){
	 		$link=explode("=",$book_code[$i]);
					$book_link=$link[0];
					$book_link_final="http://ncert.nic.in/textbook/pdf/".$book_link."cc.jpg";
					
        if($i==4 || $i==8 || $i==12 || $i==16 || $i==20 || $i==24 || $i==28 || $i==32 || $i==36 || $i==40 || $i==44 || $i==48 || $i==52 || $i==56 || $i==60 || $i==64 || $i==68 || $i==72 || $i==76 || $i==80 || $i==84 || $i==88 || $i==92 ){
		$total_td=0;
     $x=$total-$i;
			  if($x<4){
			  $total_td=4-$x;
			  }

		?>
		</tr>
	
		 	  <tr style="height:250px;  background-image: url('images/bookshelf_empty_tr.png');">
	<?php 	} 
		
	?>	
	 <td><center><h5 class="h"><?php echo $subject_name[$i]; ?></h5><img src="<?php echo $book_link_final; ?>" id="<?php echo $book_code[$i]."/".$book_name[$i]."/".$subject_name[$i] ?>" onclick="get_chapter(this.id);" style=" height:160px; width:120px;"/></center></td>
			
<?php

	 } 
	 
	  for($p=0;$p<$total_td;$p++){ ?>	
<td></td>
<?php  }
	 ?>
	 </tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
	 <tr></tr>
