-- #! mysql
-- #{ factionlegends

-- # { loaddata
SELECT * FROM factions, players, home, lang;
-- # }

-- # { faction

-- # { init
CREATE TABLE IF NOT EXISTS factions
(
    name VARCHAR(36) PRIMARY KEY,
    description TEXT,
    status VARCHAR(255),
    players TEXT,
    power INTEGER,
    money INTEGER,
    allies TEXT,
    claims TEXT
    );
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

-- # }

-- # { lang

-- # { init

CREATE TABLE IF NOT EXISTS lang
(
    name VARCHAR(36) PRIMARY KEY,
    lang VARCHAR(255)
    );

-- # }

-- # }
-- #}