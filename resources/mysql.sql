-- #! mysql
-- #{ factionlegends

-- # { faction

-- # { init
CREATE TABLE IF NOT EXISTS factions
(
    name VARCHAR(36) PRIMARY KEY,
    description TEXT,
    players TEXT,
    power INTEGER,
    money INTEGER,
    allies TEXT,
    claims TEXT
    );
-- # }

-- # { load
SELECT * FROM factions;
-- # }

-- # }

-- # { player

-- # { init

CREATE TABLE IF NOT EXISTS players
(
    name VARCHAR(36) PRIMARY KEY,
    faction VARCHAR(255),
    role VARCHAR(255)
    );

-- # }

-- # { load
SELECT * FROM players;
-- # }

-- # }

-- # { home

-- # { init

CREATE TABLE IF NOT EXISTS home
(
    name VARCHAR(36) PRIMARY KEY,
    faction VARCHAR(255),
    x INTEGER,
    y INTEGER,
    z INTEGER,
    world VARCHAR(255)
    );

-- # }

-- # { load
SELECT * FROM home;
-- # }

-- # }

-- # { lang

-- # { init

CREATE TABLE IF NOT EXISTS lang
(
    name VARCHAR(36) PRIMARY KEY,
    lang VARCHAR(255),
    );

-- # }

-- # { load
SELECT * FROM lang;
-- # }

-- # }
-- #}