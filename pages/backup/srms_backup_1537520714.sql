

CREATE TABLE `acadyears_tbl` (
  `ay_id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(20) NOT NULL,
  PRIMARY KEY (`ay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO acadyears_tbl VALUES("1","2016-2017");
INSERT INTO acadyears_tbl VALUES("2","2019-2020");
INSERT INTO acadyears_tbl VALUES("4","2018-2019");
INSERT INTO acadyears_tbl VALUES("5","2017-2018");
INSERT INTO acadyears_tbl VALUES("6","2015-2016");



CREATE TABLE `adcreds_tbl` (
  `ad_cred_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_cred` varchar(255) NOT NULL,
  PRIMARY KEY (`ad_cred_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO adcreds_tbl VALUES("1","TOR");
INSERT INTO adcreds_tbl VALUES("2","Form 137");



CREATE TABLE `civil_stat_tbl` (
  `civil_stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`civil_stat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO civil_stat_tbl VALUES("1","Single");
INSERT INTO civil_stat_tbl VALUES("2","Married");
INSERT INTO civil_stat_tbl VALUES("3","Widowed");
INSERT INTO civil_stat_tbl VALUES("4","Annul");
INSERT INTO civil_stat_tbl VALUES("5","Separated");



CREATE TABLE `courses_tbl` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(255) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO courses_tbl VALUES("1","Bachelor of Science in Hotel and Restaurant Management");
INSERT INTO courses_tbl VALUES("2","Bachelor in Elementary Education");
INSERT INTO courses_tbl VALUES("3","Bachelor of Science in Computer Science");
INSERT INTO courses_tbl VALUES("4","Bachelor in Secondary Education");
INSERT INTO courses_tbl VALUES("5","Bachelor of Science in Business Administrations");



CREATE TABLE `enrolled_subj_tbl` (
  `enrolled_subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `ay_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `ofgrade` varchar(10) NOT NULL,
  PRIMARY KEY (`enrolled_subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `forgot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `gender_tbl` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO gender_tbl VALUES("1","Male");
INSERT INTO gender_tbl VALUES("2","Female");



CREATE TABLE `majors_tbl` (
  `major_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `major_name` varchar(255) NOT NULL,
  PRIMARY KEY (`major_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `prereq_tbl` (
  `prerequisite_id` int(11) NOT NULL AUTO_INCREMENT,
  `prereq_code` varchar(50) NOT NULL,
  `prereq_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`prerequisite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO prereq_tbl VALUES("6","FILI 111","Komunikasyon sa Akademikong Pilipino");
INSERT INTO prereq_tbl VALUES("7","ENGL 111","Communication Skills 1");
INSERT INTO prereq_tbl VALUES("8","None","None");
INSERT INTO prereq_tbl VALUES("9","MATH 111","College Algebra");
INSERT INTO prereq_tbl VALUES("10","COMP 211","Object-Oriented Programming");
INSERT INTO prereq_tbl VALUES("11","PHYS 211","Physics 1");
INSERT INTO prereq_tbl VALUES("12","COMP 111","qwe");
INSERT INTO prereq_tbl VALUES("13","COMP 112","qweqwe");
INSERT INTO prereq_tbl VALUES("14","CHCL 111","asd");
INSERT INTO prereq_tbl VALUES("15","PHED 111","None");
INSERT INTO prereq_tbl VALUES("16","NSTP 11","None");
INSERT INTO prereq_tbl VALUES("17","ENGL 121","None");
INSERT INTO prereq_tbl VALUES("18","FILI 121","None");
INSERT INTO prereq_tbl VALUES("19","COMP 122/123","None");
INSERT INTO prereq_tbl VALUES("20","COMP 111/122","None");
INSERT INTO prereq_tbl VALUES("21","COMP 121","None");
INSERT INTO prereq_tbl VALUES("22","PHED 121","None");
INSERT INTO prereq_tbl VALUES("23","COMP 213","None");
INSERT INTO prereq_tbl VALUES("24","COMP 212","None");
INSERT INTO prereq_tbl VALUES("25","PHED 211","None");
INSERT INTO prereq_tbl VALUES("26","MATH 123","None");
INSERT INTO prereq_tbl VALUES("27","COMP 123","None");
INSERT INTO prereq_tbl VALUES("28","MATH 124","None");
INSERT INTO prereq_tbl VALUES("29","COMP 225","None");
INSERT INTO prereq_tbl VALUES("30","COMP 323","None");
INSERT INTO prereq_tbl VALUES("31","COMP 411","None");
INSERT INTO prereq_tbl VALUES("32","COMP 412","None");



CREATE TABLE `remarks_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remark` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `semester_tbl` (
  `sem_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(255) NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO semester_tbl VALUES("1","1st");
INSERT INTO semester_tbl VALUES("2","2nd");
INSERT INTO semester_tbl VALUES("3","summer");



CREATE TABLE `stud_subj_tbl` (
  `stud_subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_id` int(11) NOT NULL,
  `ay_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  `ofgrade` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`stud_subj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO stud_subj_tbl VALUES("1","2","5","2","2","2","1.00");
INSERT INTO stud_subj_tbl VALUES("2","2","1","1","2","4","2.25");
INSERT INTO stud_subj_tbl VALUES("5","2","5","2","1","5","2.00");
INSERT INTO stud_subj_tbl VALUES("6","2","5","2","2","12","5.00");
INSERT INTO stud_subj_tbl VALUES("7","2","1","1","1","16","2.00");
INSERT INTO stud_subj_tbl VALUES("8","2","1","2","2","8","2.50");
INSERT INTO stud_subj_tbl VALUES("9","4","1","2","1","2","5.00");
INSERT INTO stud_subj_tbl VALUES("10","4","1","2","1","3","2.00");
INSERT INTO stud_subj_tbl VALUES("11","4","1","2","1","4","1.00");
INSERT INTO stud_subj_tbl VALUES("12","4","1","2","1","5","INC");
INSERT INTO stud_subj_tbl VALUES("13","4","1","2","1","7","3.00");
INSERT INTO stud_subj_tbl VALUES("14","4","1","2","1","8","2.75");
INSERT INTO stud_subj_tbl VALUES("15","4","4","1","2","9","5.00");
INSERT INTO stud_subj_tbl VALUES("16","4","1","1","2","10","1.00");
INSERT INTO stud_subj_tbl VALUES("17","2","5","2","3","26","2.00");
INSERT INTO stud_subj_tbl VALUES("18","2","5","2","3","31","1.00");
INSERT INTO stud_subj_tbl VALUES("19","2","5","2","3","32","2.00");



CREATE TABLE `students_tbl` (
  `stud_id` int(11) NOT NULL AUTO_INCREMENT,
  `stud_no` varchar(50) NOT NULL,
  `course_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `highschool` varchar(255) NOT NULL,
  `year_graduated` int(11) NOT NULL,
  `last_school` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `dateofadmission` varchar(255) NOT NULL,
  `ad_cred_id` int(11) NOT NULL,
  `degreeobtained` varchar(255) DEFAULT NULL,
  `dategraduated` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`stud_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO students_tbl VALUES("2","b16-1-0022","3","Fajut","Van Halen","Magabo","#83 Bayanan, Bacoor, Cavite","1994-10-26","Lipa City","1","Bolbok National Highschool","2011","KLL","Roseller F. Fajut","Luz M. Fajut","2018-08-28","1","","","user","user");
INSERT INTO students_tbl VALUES("3","b17-1-0003","2","Hular","Justine Kenneth","Hernandez","Mabini st. south 2","1996-10-07","Calapan City, Oriental Mindoro","1","Ginagawamue highschool","2013","EAC-C","Jose M. Hular","Antoneth H. Hular","","0","","","user2","user2");
INSERT INTO students_tbl VALUES("5","b15-1-0031","3","Zambrano","Christian","Dela Cruz","Mambog","1997-01-04","City of Bacoor","1","Macasa Highschool","2014","SFAC","Nilo Zambrano","Lennie Zambrano","2018-09-11","1","","","tian123","$2y$10$gDwffGs2QYdXDgHpI13LvuQvj8kTiyFZZxmxrM9dmUTnlqxDCCMZ.");



CREATE TABLE `subjects_tbl` (
  `subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(50) NOT NULL,
  `subj_desc` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `prerequisite_id` int(11) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

INSERT INTO subjects_tbl VALUES("2","FILI 121","Pagbasa at Pagsulat Tungo sa Pananaliksik ","1","6");
INSERT INTO subjects_tbl VALUES("3","ENGL 111","Communication Skills 1","1","8");
INSERT INTO subjects_tbl VALUES("4","ENGL 121","Communication Skills 2","1","7");
INSERT INTO subjects_tbl VALUES("5","FILI 111","Komunikasyon Sa Akademikong Filipino","1","8");
INSERT INTO subjects_tbl VALUES("7","COMP 313","Design & Implementation of Programming Languages","1","10");
INSERT INTO subjects_tbl VALUES("8","NSTP 11","National Service Training Program 1","1","8");
INSERT INTO subjects_tbl VALUES("9","PHYS 221","Physics 2","1","11");
INSERT INTO subjects_tbl VALUES("10","RZAL 221","Rizal's Life, Works & Writings","1","8");
INSERT INTO subjects_tbl VALUES("11","MATH 111","College Algebra","1","8");
INSERT INTO subjects_tbl VALUES("12","CHEM 111","General Chemistry","4","8");
INSERT INTO subjects_tbl VALUES("13","COMP 111","I.T. Concepts and Fundamentals","1","8");
INSERT INTO subjects_tbl VALUES("14","COMP 112","Fundamentals of Problem Solving & Programming 1","1","8");
INSERT INTO subjects_tbl VALUES("15","CHCL 111","Christian Community Living 1","3","8");
INSERT INTO subjects_tbl VALUES("16","PHED 111","Physical Education 1","2","8");
INSERT INTO subjects_tbl VALUES("17","MATH 123","Advanced Algebra and Trigonometry","2","9");
INSERT INTO subjects_tbl VALUES("18","MATH 124","Discrete Mathematics3","1","9");
INSERT INTO subjects_tbl VALUES("19","COMP 121","Integrated Software and Productivity Tools","1","12");
INSERT INTO subjects_tbl VALUES("20","COMP 122","Fundamentals of Problem Solving & Programming 2","1","13");
INSERT INTO subjects_tbl VALUES("21","COMP 123","Data Structures","1","13");
INSERT INTO subjects_tbl VALUES("22","CHCL 121","Christian Community Living 2","3","14");
INSERT INTO subjects_tbl VALUES("23","PHED 121","Physical Education 2","2","15");
INSERT INTO subjects_tbl VALUES("24","NSTP 12","National Service Training Program 2","1","16");
INSERT INTO subjects_tbl VALUES("25","ENGL 211","Oral Communication & Public Speaking","1","17");
INSERT INTO subjects_tbl VALUES("26","FILI 211","Masining na Pagpapahayag","1","18");
INSERT INTO subjects_tbl VALUES("27","HIST 211","Philippine History","1","8");
INSERT INTO subjects_tbl VALUES("28","GPSY 211","General Psychology","1","8");
INSERT INTO subjects_tbl VALUES("29","ACTG 212","Introduction to Accounting","1","8");
INSERT INTO subjects_tbl VALUES("30","COMP 211","Object-Oriented Programming","1","19");
INSERT INTO subjects_tbl VALUES("31","COMP 212","Database Management Systems","1","19");
INSERT INTO subjects_tbl VALUES("32","COMP 213","Intro to Comp. Org. Architecture and Machine Level Programming","1","20");
INSERT INTO subjects_tbl VALUES("33","COMP 214","Presentation Skills in I.T.","1","21");
INSERT INTO subjects_tbl VALUES("34","PHED 211","Physical Education 3","2","22");
INSERT INTO subjects_tbl VALUES("35","CONS 221","Philippine Government & Constitution","1","0");
INSERT INTO subjects_tbl VALUES("36","ENGL 221","Business and Technical Writing","1","17");
INSERT INTO subjects_tbl VALUES("37","COMP 221","Operating System","1","23");
INSERT INTO subjects_tbl VALUES("38","COMP 222","Network Principles, Management & Programming","1","23");
INSERT INTO subjects_tbl VALUES("39","COMP 223","Web Development & Programming","1","24");
INSERT INTO subjects_tbl VALUES("40","COMP 224","Ethics I.T. Professionals","1","12");
INSERT INTO subjects_tbl VALUES("41","COMP 225","Systems Analysis & Design","1","24");
INSERT INTO subjects_tbl VALUES("42","FRLG 221","Foreign Language 1 (Niponggo)","1","8");
INSERT INTO subjects_tbl VALUES("43","PHED 221","Physical Education 4","2","11");
INSERT INTO subjects_tbl VALUES("44","ECON 311","Economics with Agrarian Reform & Taxation","1","8");
INSERT INTO subjects_tbl VALUES("45","MATH 212","Analytic Geometry & Intro to Calculus","1","26");
INSERT INTO subjects_tbl VALUES("46","COMP 311","Automata Language & Theory","1","26");
INSERT INTO subjects_tbl VALUES("47","COMP 312","Design & Analysis of Algorithms","1","27");
INSERT INTO subjects_tbl VALUES("48","COMP 314","Artificial Intelligence","1","28");
INSERT INTO subjects_tbl VALUES("49","CSEL 311","C.S. Elective 1","1","8");
INSERT INTO subjects_tbl VALUES("50","LITE 321","Introduction to Literature","1","0");
INSERT INTO subjects_tbl VALUES("51","MATH 323","Statistics & Probabilities","1","0");
INSERT INTO subjects_tbl VALUES("52","COMP 321","Digital Design","1","23");
INSERT INTO subjects_tbl VALUES("53","COMP 322","Software Engineering","1","29");
INSERT INTO subjects_tbl VALUES("54","CSEL 2","C.S Elective 2","1","0");
INSERT INTO subjects_tbl VALUES("55","CSFR 1","Free Elective 1","1","0");
INSERT INTO subjects_tbl VALUES("56","SOCS 411","Society & Culture w/ Family Planning","1","0");
INSERT INTO subjects_tbl VALUES("57","HUma 111","Music, Art Education & Appreciation","1","0");
INSERT INTO subjects_tbl VALUES("58","COMP 411","Special Project 1","1","30");
INSERT INTO subjects_tbl VALUES("59","COMP 412","Current & Future Trends in Computing","1","0");
INSERT INTO subjects_tbl VALUES("60","CSEL 3","C.S Elective 3","1","0");
INSERT INTO subjects_tbl VALUES("61","CSFR 2","Free Elective 3","1","0");
INSERT INTO subjects_tbl VALUES("62","PRAC 331","Internship","8","30");
INSERT INTO subjects_tbl VALUES("63","PHIL 421","Philosophy of Man with Logic","1","0");
INSERT INTO subjects_tbl VALUES("64","COMP 421","Special Project 2","1","31");
INSERT INTO subjects_tbl VALUES("65","COMP 422","Seminars and Field Trips","3","32");
INSERT INTO subjects_tbl VALUES("66","CSEL 4","C.S Elective 4","1","0");
INSERT INTO subjects_tbl VALUES("67","CSFR 3","Free Elective 3","1","0");



CREATE TABLE `tbl_admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_fname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_admins VALUES("1","Van Halen","Fajut","admin","$2y$10$I63kGh9OMya/AxGsktg7YuT7qYJRf1hMPp9Rm5QZOjijtRk1t053W");



CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_users VALUES("1","Van","Fajut","makuv3x@gmail.com","van123","asdfgh");
INSERT INTO tbl_users VALUES("2","Tian","Zambrano","chirstianz30@gmail.com","tian123","$2y$10$Klq62SwKiTxNBxuwXrYDVeksR7qgLY3aQ26EYUWO7sM9ESCe9v57G");
INSERT INTO tbl_users VALUES("3","Jason","Casas","jason_kid0@yahoo.com","jason123","$2y$10$PRvZxfm8/eBIBTU/RGOat.9wNV0TWd.YkunXXq9qKTJ.e6cIMzyAe");



CREATE TABLE `units_tbl` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(5) NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO units_tbl VALUES("1","3");
INSERT INTO units_tbl VALUES("2","2");
INSERT INTO units_tbl VALUES("3","1");
INSERT INTO units_tbl VALUES("4","4");
INSERT INTO units_tbl VALUES("5","5");
INSERT INTO units_tbl VALUES("6","5");
INSERT INTO units_tbl VALUES("7","7");
INSERT INTO units_tbl VALUES("8","6");



CREATE TABLE `yearlevel_tbl` (
  `year_id` int(11) NOT NULL AUTO_INCREMENT,
  `year_level` varchar(255) NOT NULL,
  PRIMARY KEY (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO yearlevel_tbl VALUES("1","1st");
INSERT INTO yearlevel_tbl VALUES("2","2nd");
INSERT INTO yearlevel_tbl VALUES("3","3rd");
INSERT INTO yearlevel_tbl VALUES("4","4th");

