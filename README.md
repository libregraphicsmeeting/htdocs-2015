# htdocs-lgm2015

website for the lgm 2015

## Content

The website will probably contain:

- a blog with news
- an about page
- a conferences submission page
- the program
- a travel & accomodation page
- a venue page
- a liste of projects participating in the lgm
- a registration form and a list of participants
- a list of sponsors
- a contact / resources page for the press
- a contact page
- a list of articles on the LGM

To feed this, we will need in the in the background:

- a blog engine
- a pages editor
- a way to submit conferences
- a way to submit the slides
- a way to register

## Blog engine

Currently we are using Wordpress

- we actually don't blog that much.
- there are no notable problems with it.


## Editing pages

Currently we are using Wordpress

- It works ok
- There are some concerns about the site not being revisioned and automatically backuped

## User submissions (registration, call for conferences, slides, ...)

Currently we have an old version of Gravity Forms for creating forms that are presented to public

- The interface for creating forms is very good
- Exporting to CSV works well
- Dynamically pulling the data into lists (schedule, ...) is more painful than it should be, but we now have a class for the most tedious part)
- Some tweaks to the plugin would be necessary (but since the plugin is not really free...)
- The code for pulling the data is currently implemented as `.php` files in the theme: they should probably be converted in plugins.
- Manuel suggest that we could use "his" [minimalistic event manager](https://github.com/ms-studio/minimalistic-event-manager) plugin for WP
- Louis has proposed:
  - <http://wordpress.org/support/topic/plugin-events-manager-list-of-attendees>
  - <http://wordpress.org/support/topic/plugin-events-manager-display-attendees-in-a-page>
  - <http://wordpress.org/plugins/event-registration/>
  - <http://www.dfactory.eu/plugins/events-maker/>
  - <http://wordpress.org/plugins/events-manager/>
