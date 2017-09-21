# -----------------------------------------------------------------------------
#       TABLE : JOKES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JOKES
(
  ID INTEGER NOT NULL AUTO_INCREMENT,
  ID_CATEGORIZE INTEGER NOT NULL  ,
  ID_POST INTEGER NOT NULL  ,
  CONTENT TEXT NOT NULL  ,
  POSTED_AT DATETIME NOT NULL  ,
  EDITED_AT DATETIME NULL  ,
  DELETED_AT DATETIME NULL
  , PRIMARY KEY (ID)
);

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE JOKES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_JOKES_CATERORIES
  ON JOKES (ID_CATEGORIZE ASC);

CREATE  INDEX I_FK_JOKES_USERS
  ON JOKES (ID_POST ASC);

# -----------------------------------------------------------------------------
#       TABLE : USERS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USERS
(
  ID INTEGER NOT NULL  ,
  LOGIN VARCHAR(255) NOT NULL UNIQUE ,
  PASSWORD VARCHAR(255) NOT NULL  ,
  MAIL VARCHAR(255) NOT NULL UNIQUE ,
  FIRSTNAME VARCHAR(255) NULL  ,
  LASTNAME VARCHAR(255) NULL  ,
  BIRTHDATE DATE NULL  ,
  REGISTRED_AT DATETIME NOT NULL  ,
  LAST_LOGGED DATETIME NULL
  , PRIMARY KEY (ID)
);

# -----------------------------------------------------------------------------
#       TABLE : CATERORIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATERORIES
(
  ID INTEGER NOT NULL  ,
  NAME VARCHAR(255) NOT NULL  ,
  DELETED_AT DATETIME NULL
  , PRIMARY KEY (ID)
);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE JOKES
  ADD FOREIGN KEY FK_JOKES_CATERORIES (ID_CATEGORIZE)
REFERENCES CATERORIES (ID) ;


ALTER TABLE JOKES
  ADD FOREIGN KEY FK_JOKES_USERS (ID_POST)
REFERENCES USERS (ID) ;

