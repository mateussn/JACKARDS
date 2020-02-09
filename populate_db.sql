use jackards_db;

insert into `user`(name, username, e_mail, phone, `password`) values
('John Von Newman', 'john_von', 'john.von.newman@mail.com', '+55074999999009',
'newman, von'),
('João Kléber', 'para_para', 'joao.kleber.fake@mail.com', '+55074999815573',
'rede_tv'),
('Seu Madruga', 'madruguinha', 'bruxa.71@mail.com', '+55074981434489',
'acapulco');

insert into card_name(id, image_path) values
('Atog', 'atog.jpg'),
("Hidetsugu's Second Rite", 'hidetsugus_second_rite.jpg'),
('Rite of Belzenlok', 'rite_of_belzenlok.jpg'),
('Thief of Sanity', 'thief_of_sanity.jpg');
