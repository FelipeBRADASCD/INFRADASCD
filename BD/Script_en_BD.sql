use bd_infradascd;
select * from usuarios;
select * from dependencias;
select * from plataformatecnologica;
select * from usuarioplataforma;
select * from gestorclaves;

insert into plataformatecnologica (nombreplataforma, descripcion, enlace)
values ("GESTIONA360", "Sistema de Gestión Institucional","https://gestiona360.azurewebsites.net/login.php")
values ("SIGA", "Sistema de Gestión Documental","https://siga.serviciocivil.gov.co/WebSGD/")
values ("SIDEAP", "Sistema de talento Humano","https://sideap.serviciocivil.gov.co/sideap/");

insert into usuarioplataforma (nombre_usuario, correo, idplataforma)
values ("admin","admin@serv.gov.co","1")
values ("administrator","administrator@serv.gov.co","2")
values ("administrador","administrador@serv.gov.co","2")
values ("soporte","soporte@serv.gov.co","3");

insert into gestorclaves (hashclave, idusuarioplataforma)
values ("U0lERUFQMjAyMyo=","1");

insert into usuarios (username, cedula, correo, nombres, apellidos, iddependencia, contrasena, cargo, activo, rol)
values ("kreyes",1022933108,"kreyes@serviciocivil.gov.co","Karen","Reyes",1,"$2y$10$ElD/WMooYvGZBeWErImAg.tmZl.MHjAPXk36KO1G.paW.aGs6CJJS","Profesional",1,1);

update usuarios set contrasena = "$2y$10$KMfHXBFyfohNTOdjv.ydye.FmfS6P2uzyf7V7MBmoWHy55V78Esbq" where username="kreyes";

INSERT INTO dependencias (iddependencia,coddependencia,nombredependencia,sigladependencia,fechacreacion) VALUES 
(1,130,'Oficina de las Tecnologías y Comunicaciones','OTIC','2023-06-16 16:47:33'),
(2,500,'Subdirección de Planeación y Gestión de Información del Talento Humano Distrital','SPGITH','2023-06-30 17:52:22'),
(3,400,'Subdirección de Gestión Distrital de Bienestar, Desarrollo y Desempeño','SBD','2023-07-01 06:01:08'),
(4,200,'Subdirección Técnica de Desarrollo Organizacional y Empleo Público','STDOEP','2023-07-01 06:01:08'),
(5,300,'Subdirección Jurídica','SJ','2023-07-01 06:01:08'),
(6,600,'Subdirección de Gestión Corporativa','SGC','2023-07-01 06:01:08'),
(7,110,'Oficina de Control Interno','OCI','2023-07-01 06:04:59'),
(8,120,'Oficina de Control Disciplinario Interno','OCDI','2023-07-01 06:04:59');



SELECT pt.nombreplataforma, pt.descripcion, pt.enlace, up.nombre_usuario, up.correo, gc.hashclave, gc.fechacreacion
FROM usuarioplataforma as up
INNER JOIN gestorclaves as gc ON up.idusuarioplataforma = gc.idusuarioplataforma
INNER JOIN plataformatecnologica as pt ON up.idplataforma = pt.idplataforma
ORDER BY pt.nombreplataforma ASC




