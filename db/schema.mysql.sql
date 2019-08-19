-- route types, for reference in 'route' table
CREATE TABLE route_type (
  id VARCHAR(255) NOT NULL PRIMARY KEY
) DEFAULT CHARSET=utf8;

INSERT INTO route_type (id) VALUES ('PRIMARY');
INSERT INTO route_type (id) VALUES ('SECONDARY');
INSERT INTO route_type (id) VALUES ('TERTIARY');

-- route model
CREATE TABLE route (
  id VARCHAR(255) NOT NULL PRIMARY KEY, -- random string/number?
  lower_date INTEGER,
  lower_date_error INTEGER,
  upper_date INTEGER,
  upper_date_error INTEGER,
  route_type VARCHAR(255),
  geom_kml MEDIUMTEXT,
  description TEXT, 
  citation TEXT,
  FOREIGN KEY(route_type) REFERENCES route_type(id)
) DEFAULT CHARSET=utf8;

-- place model
CREATE TABLE place (
  gazetteer_uri VARCHAR(1024) NOT NULL PRIMARY KEY, 
  name VARCHAR(1024), -- NOT NULL?
  notes TEXT
) DEFAULT CHARSET=utf8;

-- network model
CREATE TABLE network_edge (
  id VARCHAR(255) NOT NULL PRIMARY KEY, -- random string/number?
  route_id VARCHAR(255) NOT NULL,
  from_place VARCHAR(1024) NOT NULL,
  to_place VARCHAR(1024) NOT NULL,
  notes TEXT,
  FOREIGN KEY(route_id) REFERENCES route(id),
  FOREIGN KEY(from_place) REFERENCES place(gazetteer_uri),
  FOREIGN KEY(to_place) REFERENCES place(gazetteer_uri)
) DEFAULT CHARSET=utf8;

-- named route, made up of many route instances
CREATE TABLE named_route (
  id VARCHAR(255) NOT NULL PRIMARY KEY, -- random string/number?
  name VARCHAR(1024),
  notes TEXT
) DEFAULT CHARSET=utf8;

-- associates routes with named routes
CREATE TABLE route_is_part_of (
  id SERIAL PRIMARY KEY,
  route_id VARCHAR(255) NOT NULL,
  named_route_id VARCHAR(255) NOT NULL,
  UNIQUE KEY idx_is_part_of (route_id, named_route_id),
  FOREIGN KEY(route_id) REFERENCES route(id),
  FOREIGN KEY(named_route_id) REFERENCES named_route(id)
) DEFAULT CHARSET=utf8;

-- bibliography entry
CREATE TABLE bibliography (
  id SERIAL PRIMARY KEY, -- id doesn't need to be stable in this case, just a DB key
  bibtex TEXT
) DEFAULT CHARSET=utf8;

-- routes cite entries in the bibliography
CREATE TABLE bibliographic_citation (
  id SERIAL PRIMARY KEY,
  route_id VARCHAR(255) NOT NULL,
  bibliography_id BIGINT UNSIGNED NOT NULL,
  UNIQUE KEY idx_bibliographic_citation (route_id, bibliography_id),
  FOREIGN KEY(route_id) REFERENCES route(id),
  FOREIGN KEY(bibliography_id) REFERENCES bibliography(id)
) DEFAULT CHARSET=utf8;
