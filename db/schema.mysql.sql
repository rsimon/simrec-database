-- route types, for reference in 'route' table
CREATE TABLE route_type (
  id VARCHAR(255) NOT NULL PRIMARY KEY
) DEFAULT CHARSET=utf8;

INSERT INTO route_type (id) VALUES ('PRIMARY');
INSERT INTO route_type (id) VALUES ('SECONDARY');
INSERT INTO route_type (id) VALUES ('TERTIARY');

-- route model
CREATE TABLE route (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  lower_date INTEGER,
  lower_date_error INTEGER,
  upper_date INTEGER,
  upper_date_error INTEGER,
  route_type VARCHAR(255),
  geom_kml MEDIUMTEXT,
  min_lon DOUBLE PRECISION,
  min_lat DOUBLE PRECISION,
  max_lon DOUBLE PRECISION,
  max_lat DOUBLE PRECISION,
  description TEXT, 
  citation TEXT,
  last_updated TIMESTAMP NOT NULL,
  FOREIGN KEY(route_type) REFERENCES route_type(id)
) DEFAULT CHARSET=utf8;

-- place model
CREATE TABLE place (
  internal_place_id VARCHAR(255) NOT NULL PRIMARY KEY,
  gazetteer_uri VARCHAR(1024) NOT NULL UNIQUE, 
  name VARCHAR(1024) NOT NULL,
  notes TEXT,
  last_updated TIMESTAMP NOT NULL
) DEFAULT CHARSET=utf8;

-- network model
CREATE TABLE network_edge (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  route_id VARCHAR(255) NOT NULL,
  from_place VARCHAR(1024) NOT NULL,
  to_place VARCHAR(1024),
  notes TEXT,
  last_updated TIMESTAMP NOT NULL,
  FOREIGN KEY(route_id) REFERENCES route(id) ON DELETE CASCADE,
  FOREIGN KEY(from_place) REFERENCES place(internal_place_id) ON DELETE CASCADE,
  FOREIGN KEY(to_place) REFERENCES place(internal_place_id) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- named route, made up of many route instances
CREATE TABLE named_route (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  name VARCHAR(1024) NOT NULL,
  notes TEXT,
  last_updated TIMESTAMP NOT NULL
) DEFAULT CHARSET=utf8;

-- associates routes with named routes
CREATE TABLE route_is_part_of (
  id SERIAL PRIMARY KEY,
  route_id VARCHAR(255) NOT NULL,
  named_route_id VARCHAR(255) NOT NULL,
  UNIQUE KEY idx_is_part_of (route_id, named_route_id),
  FOREIGN KEY(route_id) REFERENCES route(id) ON DELETE CASCADE,
  FOREIGN KEY(named_route_id) REFERENCES named_route(id) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- bibliography entry
CREATE TABLE bibliography (
  id SERIAL PRIMARY KEY, -- id doesn't need to be stable in this case, just a DB key
  label VARCHAR(255) NOT NULL,
  bibtex TEXT
) DEFAULT CHARSET=utf8;

-- routes cite entries in the bibliography
CREATE TABLE bibliographic_citation (
  id SERIAL PRIMARY KEY,
  route_id VARCHAR(255) NOT NULL,
  bibliography_id BIGINT UNSIGNED NOT NULL,
  UNIQUE KEY idx_bibliographic_citation (route_id, bibliography_id),
  FOREIGN KEY(route_id) REFERENCES route(id) ON DELETE CASCADE,
  FOREIGN KEY(bibliography_id) REFERENCES bibliography(id) ON DELETE CASCADE
) DEFAULT CHARSET=utf8;

-- view for easily getting all places on a route
CREATE VIEW place_is_part_of AS
  SELECT
    route_id,
    internal_place_id,
    gazetteer_uri,
    name AS place_name
  FROM network_edge 
  JOIN place ON place.internal_place_id = network_edge.from_place 
    OR place.internal_place_id = network_edge.to_place 
  GROUP BY route_id, internal_place_id, gazetteer_uri, name;
