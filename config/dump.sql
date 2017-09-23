# -----------------------------------------------------------------------------
#       TABLE : JOKES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS JOKES
(
  ID INTEGER NOT NULL AUTO_INCREMENT,
  CATEGORY_ID INTEGER NOT NULL  ,
  USER_ID INTEGER NOT NULL  ,
  CONTENT TEXT NOT NULL  ,
  CREATED_AT DATETIME NOT NULL  ,
  UPDATED_AT DATETIME NULL  ,
  DELETED_AT DATETIME NULL
  , PRIMARY KEY (ID)
);

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE JOKES
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_JOKES_CATEGORIES
  ON JOKES (CATEGORY_ID ASC);

CREATE  INDEX I_FK_JOKES_USERS
  ON JOKES (USER_ID ASC);

# -----------------------------------------------------------------------------
#       TABLE : USERS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USERS
(
  ID INTEGER NOT NULL AUTO_INCREMENT,
  LOGIN VARCHAR(255) NOT NULL UNIQUE ,
  PASSWORD VARCHAR(255) NOT NULL  ,
  MAIL VARCHAR(255) NOT NULL UNIQUE ,
  FIRSTNAME VARCHAR(255) NULL  ,
  LASTNAME VARCHAR(255) NULL  ,
  BIRTHDATE DATE NULL  ,
  REGISTRED_AT DATETIME NOT NULL  ,
  LAST_LOGGED DATETIME NULL ,
  DELETED_AT DATETIME NULL
  , PRIMARY KEY (ID)
);

# -----------------------------------------------------------------------------
#       TABLE : CATERORIES
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORIES
(
  ID INTEGER NOT NULL AUTO_INCREMENT,
  NAME VARCHAR(255) NOT NULL  ,
  DELETED_AT DATETIME NULL
  , PRIMARY KEY (ID)
);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE JOKES
  ADD FOREIGN KEY FK_JOKES_CATEGORIES (CATEGORY_ID)
REFERENCES CATEGORIES (ID) ;


ALTER TABLE JOKES
  ADD FOREIGN KEY FK_JOKES_USERS (USER_ID)
REFERENCES USERS (ID) ;