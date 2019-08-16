# SIMREC Database

Data entry webapp for the SIMREC project. Work in progress.

# UI

The initial UI will be based on [GroceryCRUD](https://www.grocerycrud.com/). Documentation
to follow. In the mean time:

- Configure DB settings in `ui/application/config/database.php` (username, password, DB name)
- Run `php -S localhost:8000 -t ui` to start dev mode.
- Go to [http://localhost:8080/ui](http://localhost:8080/ui)

## Open Questions/Notes

- What should we use as identifier for routes, etc.? Are UUIDs acceptable? (Would simplify things a lot, especially
  with GroceryCRUD)
- I generally renamed col names such as `pleiades_uri` to `gazetteer_uri`
- In the diagram, there are two n-to-m association tables between places and routes, one "direct" and one for the 
  network. What's the purpose behind this separation/duplication? Can the two tables contain different information?
- Should place.name have a NOT NULL constraint? (Generally, places _could_ be unnamed...)
- Likewise, should named_route.name be NOT NULL?
- Where in the schema should we define indices? (I assume it won't make much difference due to DB size, but still.)
  - route.lower_date, route.upper_date?
  - route.route_type?
  - place.name
  - named_route.name
- Turns out some tables currently don't work because GroceryCRUD simply doesn't support compound primary keys. Needs
  a few changes to the schema to fix  this.

## Key Todos

- Sort out identifier issue & revise DB init script accordingly
- Eliminate compound primary keys, so we can use GroceryCRUD (and revise DB init script accordingly)
