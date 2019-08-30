# SIMREC Database

Data entry web application for the SIMREC project. Work in progress.

# Setup

The user interface is based on [GroceryCRUD](https://www.grocerycrud.com/). To set up the project,
clone the repository and:

- Configure DB settings in `ui/application/config/database.php` (username, password, DB name)
- To run in dev mode: `php -S localhost:8000 -t ui`
- Go to [http://localhost:8000/crud/routes](http://localhost:8000/crud/routes)

## TODOs  & Questions

- [ ] What should we use as identifiers for __routes__, __network edges__ and __named routes__? I'm not a fan of 
  auto-generated serial integers. UUIDs? Random alphanumeric strings?
- [ ] GroceryCRUD has problems with using URIs as unique IDs (relevant for __places__). What to use instead? (A 
  slug based on gazetteer URI?)
- [x] I renamed column names such as `pleiades_uri` to `gazetteer_uri`. Ok? Or keep Pleiades?
- [ ] In the diagram, there are two n-to-m association tables between places and routes, one "direct" and one for the 
  network. What's the purpose behind this separation/duplication? Can the two tables contain different information?
- [x] Should __place.name__ have a NOT NULL constraint? (Generally, places _could_ be unnamed...)
- [x] Likewise, should __named_route.name__ be NOT NULL?
- [x] ~~Where in the schema should we define indices? (I assume it won't make much difference due to DB size, but still.)~~ Won't implement for now.
  - ~~route.lower_date, route.upper_date?~~
  - ~~route.route_type?~~
  - ~~place.name~~
  - ~~named_route.name~~
- [x] GroceryCRUD does not support compound primary keys. Redesign the schema to get rid of them.
- [x] We need some kind of basic auth
- [x] Looks like it's currently not possible to delete a route that is part of a named route
- [ ] BibTex bibliography: can we make this searchable in the GroceryCRUD dropdown?
