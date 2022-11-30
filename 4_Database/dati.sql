# User
insert into user values ('dennis.donofrio@gmail.com','cdad832bfad2df1ce0132e032d657544aadd9897eb237a9b6a1cf754e84a5c22');
insert into user values ('admin@gmail.com','b85168fa6bfe3208355d0c74f0c8dd6379f2c9c634303a2236afc7caba9cc17d');
insert into user values ('andrea.curti@gmail.com','7aa53a4d20a1882d92fab30f2b21744c87e7a14ff6d48e4d2a24b282adafc384');

# Client
insert into client(name, surname, email, phone) values ("Mattia", "Pasquini", "mattia.pasquini@gmail.com", 0769999999);
insert into client(name, surname, email, phone) values ("Andrea", "Masciocchi", "andrea.masciocchi@gmail.com", 0769999998);
insert into client(name, surname, email, phone) values ("Manuel", "Grosso", "manuel.grosso@gmail.com", 0769999997);

# product
insert into product(name, cost, active) values ("shampoo1", 8.50, 1);
insert into product(name, cost, active) values ("shampoo2", 7.00, 1);
insert into product(name, cost, active) values ("shampoo3", 9.50, 1);

# service
insert into service(name, cost, active) values ("taglio1", 8.50, 1);
insert into service(name, cost, active) values ("taglio2", 7.00, 1);
insert into service(name, cost, active) values ("taglio3", 9.50, 1);

# method
insert into method(name) values ("cash");
insert into method(name) values ("ccp");
insert into method(name) values ("bank account");
insert into method(name) values ("compensation");
