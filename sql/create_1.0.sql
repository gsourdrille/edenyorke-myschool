drop table if exists CLASSE;

drop table if exists ETABLISSEMENT;

drop table if exists NIVEAU;

drop table if exists POST;

drop table if exists POST_CLASSE;

drop table if exists POST_ETABLISSEMENT;

drop table if exists POST_NIVEAU;

drop table if exists TYPE_UTILISATEUR;

drop table if exists UTILISATEUR;

drop table if exists UTILISATEUR_CLASSE;

drop table if exists UTILISATEUR_NIVEAU;

drop table if exists UTILISATEUR_TYPE_UTILISATEUR;

drop table if exists UTILSATEUR_ETABLISSEMENT;

/*==============================================================*/
/* Table : CLASSE                                               */
/*==============================================================*/
create table CLASSE
(
   ID_CLASSE            int not null,
   ID_NIVEAU            int,
   NOM                  text,
   primary key (ID_CLASSE)
);

/*==============================================================*/
/* Table : ETABLISSEMENT                                        */
/*==============================================================*/
create table ETABLISSEMENT
(
   ID_ETABLISSEMENT     int not null,
   NOM                  text not null,
   ADRESSE              text not null,
   CODE_POSTAL          text not null,
   VILLE                text not null,
   TELEPHONE_1          text,
   TELEPHONE_2          text,
   FAX                  text,
   primary key (ID_ETABLISSEMENT)
);

/*==============================================================*/
/* Table : NIVEAU                                               */
/*==============================================================*/
create table NIVEAU
(
   ID_NIVEAU            int not null,
   ID_ETABLISSEMENT     int,
   NOM                  text not null,
   primary key (ID_NIVEAU)
);

/*==============================================================*/
/* Table : POST                                                 */
/*==============================================================*/
create table POST
(
   ID_POST              int not null,
   ID_USER              int,
   TITRE                text not null,
   DATE_CREATION        datetime not null,
   DATE_DERNIERE_MODIFICATION datetime,
   CONTENU              text not null,
   primary key (ID_POST)
);

/*==============================================================*/
/* Table : POST_CLASSE                                          */
/*==============================================================*/
create table POST_CLASSE
(
   ID_POST              int not null,
   ID_CLASSE            int not null,
   primary key (ID_POST, ID_CLASSE)
);

/*==============================================================*/
/* Table : POST_ETABLISSEMENT                                   */
/*==============================================================*/
create table POST_ETABLISSEMENT
(
   ID_POST              int not null,
   ID_ETABLISSEMENT     int not null,
   primary key (ID_POST, ID_ETABLISSEMENT)
);

/*==============================================================*/
/* Table : POST_NIVEAU                                          */
/*==============================================================*/
create table POST_NIVEAU
(
   ID_POST              int not null,
   ID_NIVEAU            int not null,
   primary key (ID_POST, ID_NIVEAU)
);

/*==============================================================*/
/* Table : TYPE_UTILISATEUR                                     */
/*==============================================================*/
create table TYPE_UTILISATEUR
(
   ID_TYPE_UTILISATEUR  int not null,
   VALEUR               text not null,
   LIBELLE              text not null,
   primary key (ID_TYPE_UTILISATEUR)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_USER              int not null,
   NOM                  text not null,
   PRENOM               text not null,
   LOGIN                text not null,
   MOT_DE_PASSE         text,
   primary key (ID_USER)
);

/*==============================================================*/
/* Table : UTILISATEUR_CLASSE                                   */
/*==============================================================*/
create table UTILISATEUR_CLASSE
(
   ID_CLASSE            int not null,
   ID_USER              int not null,
   primary key (ID_CLASSE, ID_USER)
);

/*==============================================================*/
/* Table : UTILISATEUR_NIVEAU                                   */
/*==============================================================*/
create table UTILISATEUR_NIVEAU
(
   ID_NIVEAU            int not null,
   ID_USER              int not null,
   primary key (ID_NIVEAU, ID_USER)
);

/*==============================================================*/
/* Table : UTILISATEUR_TYPE_UTILISATEUR                         */
/*==============================================================*/
create table UTILISATEUR_TYPE_UTILISATEUR
(
   ID_USER              int not null,
   ID_TYPE_UTILISATEUR  int not null,
   primary key (ID_USER, ID_TYPE_UTILISATEUR)
);

/*==============================================================*/
/* Table : UTILSATEUR_ETABLISSEMENT                             */
/*==============================================================*/
create table UTILSATEUR_ETABLISSEMENT
(
   ID_ETABLISSEMENT     int not null,
   ID_USER              int not null,
   primary key (ID_ETABLISSEMENT, ID_USER)
);

alter table CLASSE add constraint FK_RELATION_2 foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete restrict on update restrict;

alter table NIVEAU add constraint FK_RELATION_1 foreign key (ID_ETABLISSEMENT)
      references ETABLISSEMENT (ID_ETABLISSEMENT) on delete restrict on update restrict;

alter table POST add constraint FK_CREATEUR foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table POST_CLASSE add constraint FK_POST_CLASSE foreign key (ID_POST)
      references POST (ID_POST) on delete restrict on update restrict;

alter table POST_CLASSE add constraint FK_POST_CLASSE2 foreign key (ID_CLASSE)
      references CLASSE (ID_CLASSE) on delete restrict on update restrict;

alter table POST_ETABLISSEMENT add constraint FK_POST_ETABLISSEMENT foreign key (ID_POST)
      references POST (ID_POST) on delete restrict on update restrict;

alter table POST_ETABLISSEMENT add constraint FK_POST_ETABLISSEMENT2 foreign key (ID_ETABLISSEMENT)
      references ETABLISSEMENT (ID_ETABLISSEMENT) on delete restrict on update restrict;

alter table POST_NIVEAU add constraint FK_POST_NIVEAU foreign key (ID_POST)
      references POST (ID_POST) on delete restrict on update restrict;

alter table POST_NIVEAU add constraint FK_POST_NIVEAU2 foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete restrict on update restrict;

alter table UTILISATEUR_CLASSE add constraint FK_UTILISATEUR_CLASSE foreign key (ID_CLASSE)
      references CLASSE (ID_CLASSE) on delete restrict on update restrict;

alter table UTILISATEUR_CLASSE add constraint FK_UTILISATEUR_CLASSE2 foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table UTILISATEUR_NIVEAU add constraint FK_UTILISATEUR_NIVEAU foreign key (ID_NIVEAU)
      references NIVEAU (ID_NIVEAU) on delete restrict on update restrict;

alter table UTILISATEUR_NIVEAU add constraint FK_UTILISATEUR_NIVEAU2 foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table UTILISATEUR_TYPE_UTILISATEUR add constraint FK_UTILISATEUR_TYPE_UTILISATEU foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table UTILISATEUR_TYPE_UTILISATEUR add constraint FK_UTILISATEUR_TYPE_UTILISATE2 foreign key (ID_TYPE_UTILISATEUR)
      references TYPE_UTILISATEUR (ID_TYPE_UTILISATEUR) on delete restrict on update restrict;

alter table UTILSATEUR_ETABLISSEMENT add constraint FK_UTILSATEUR_ETABLISSEMENT foreign key (ID_ETABLISSEMENT)
      references ETABLISSEMENT (ID_ETABLISSEMENT) on delete restrict on update restrict;

alter table UTILSATEUR_ETABLISSEMENT add constraint FK_UTILSATEUR_ETABLISSEMENT2 foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;
