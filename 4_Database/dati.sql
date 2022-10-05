insert into method values ('contanti');
insert into method values ('pos');
insert into method values ('twint');
insert into method values ('altro');

insert into payment values (1,'Incasso mattina',2250.65,'2022-09-12','entry','contanti');
insert into payment values (2,'Incasso mattina',530.35,'2022-09-12','entry','twint');
insert into payment values (3,'Incasso mattina',381.20,'2022-09-12','entry','pos');
insert into payment values (4,'Fornitore',590.0,'2022-09-12','expense','contanti');
insert into payment values (5,'Incasso pomeriggio',1391.70,'2022-09-12','entry','contanti');
insert into payment values (6,'Incasso pomeriggio',217.0,'2022-09-12','entry','twint');
insert into payment values (7,'Incasso giornaliero',4648.95,'2022-09-12','entry','contanti');
insert into payment values (8,'Incasso giornaliero',1127.3,'2022-09-12','entry','pos');
insert into payment values (9,'Farina',752.35,'2022-09-12','expense','altro');
insert into payment values (10,'Burro',178.0,'2022-09-12','expense','contanti');


insert into shop values (1,'Alimentari Curti','Via Fontana 23', 1);
insert into shop values (2,'Panetteria Donofrio','Via Brombei 5', 1);
insert into shop values (3,'Zanetti shop','Via Palomino 9', 0);

insert into transaction values (1,1);
insert into transaction values (1,2);
insert into transaction values (1,3);
insert into transaction values (1,4);
insert into transaction values (1,5);
insert into transaction values (1,6);
insert into transaction values (2,7);
insert into transaction values (2,8);
insert into transaction values (2,9);
insert into transaction values (2,10);


insert into user values (1,'Dennis','Donofrio','dennis.donofrio@gmail.com','cdad832bfad2df1ce0132e032d657544aadd9897eb237a9b6a1cf754e84a5c22','utente',NULL,1,1);
insert into user values (2,'Admin','','admin@gmail.com','b85168fa6bfe3208355d0c74f0c8dd6379f2c9c634303a2236afc7caba9cc17d','amministratore',1,1,NULL);
insert into user values (3,'Andrea','Curti','andrea.curti@gmail.com','7aa53a4d20a1882d92fab30f2b21744c87e7a14ff6d48e4d2a24b282adafc384','amministratore',0,1,NULL);
