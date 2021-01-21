#!/usr/bin/env python
# -*- coding: utf-8 -*-

from __future__ import absolute_import, division, print_function, unicode_literals;
import libhockeydata;

sqldatacon = libhockeydata.MakeHockeyDatabase("./php/data/hockey15-16.db3");
libhockeydata.MakeHockeyLeagueTable(sqldatacon);
libhockeydata.MakeHockeyTeamTable(sqldatacon, "ECHL");
libhockeydata.MakeHockeyConferenceTable(sqldatacon, "ECHL");
libhockeydata.MakeHockeyGameTable(sqldatacon, "ECHL");
libhockeydata.MakeHockeyDivisionTable(sqldatacon, "ECHL");
libhockeydata.MakeHockeyLeague(sqldatacon, "ECHL", "ECHL", "USA", "United States", "20151007", "Division=1,Conference=5", "ORDER BY PCT DESC, GamesPlayed ASC, TWins DESC, Losses ASC, GoalsDifference DESC");
libhockeydata.MakeHockeyConference(sqldatacon, "ECHL", "Eastern", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "East", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Elmira", "NY", "USA", "United States", "New York", "Jackals", "Eastern", "East", "First Arena", "Elmira", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Reading", "PA", "USA", "United States", "Pennsylvania", "Royals", "Eastern", "East", "Santander Arena", "Reading", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Norfolk", "VA", "USA", "United States", "Virginia", "Admirals", "Eastern", "East", "Norfolk Scope", "Norfolk", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Glens Falls", "NY", "USA", "United States", "New York", "Thunder", "Eastern", "East", "Glens Falls Civic Center", "Adirondack", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Manchester", "NH", "USA", "United States", "New Hampshire", "Monarchs", "Eastern", "East", "Verizon Wireless Arena", "Manchester", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "North", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Kalamazoo", "MI", "USA", "United States", "Michigan", "Wings", "Eastern", "North", "Wings Event Center", "Kalamazoo", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Toledo", "OH", "USA", "United States", "Ohio", "Walleye", "Eastern", "North", "Huntington Center", "Toledo", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Wheeling", "WV", "USA", "United States", "West Virginia", "Nailers", "Eastern", "North", "WesBanco Arena", "Wheeling", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Brampton", "ON", "CAN", "Canada", "Ontario", "Beast", "Eastern", "North", "Powerade Centre", "Brampton", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "South", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Duluth", "GA", "USA", "United States", "Georgia", "Gladiators", "Eastern", "South", "Infinite Energy Arena", "Atlanta", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Greenville", "SC", "USA", "United States", "South Carolina", "Swamp Rabbits", "Eastern", "South", "Bon Secours Wellness Arena", "Greenville", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Estero", "FL", "USA", "United States", "Florida", "Everblades", "Eastern", "South", "Germain Arena", "Florida", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Orlando", "FL", "USA", "United States", "Florida", "Solar Bears", "Eastern", "South", "Amway Center", "Orlando", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "North Charleston", "SC", "USA", "United States", "South Carolina", "Stingrays", "Eastern", "South", "North Charleston Coliseum", "South Carolina", "", True, True);
libhockeydata.MakeHockeyConference(sqldatacon, "ECHL", "Western", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "Midwest", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Moline", "IL", "USA", "United States", "Illinois", "Mallards", "Western", "Midwest", "iWireless Center", "Quad City", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Evansville", "IN", "USA", "United States", "Indiana", "IceMen", "Western", "Midwest", "Ford Center", "Evansville", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Indianapolis", "IN", "USA", "United States", "Indiana", "Fuel", "Western", "Midwest", "Indiana Farmers Coliseum", "Indy", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Fort Wayne", "IN", "USA", "United States", "Indiana", "Komets", "Western", "Midwest", "Allen County War Memorial Coliseum", "Fort Wayne", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Cincinnati", "OH", "USA", "United States", "Ohio", "Cyclones", "Western", "Midwest", "US Bank Arena", "Cincinnati", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "Central", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Wichita", "KS", "USA", "United States", "Kansas", "Thunder", "Western", "Central", "Intrust Bank Arena", "Wichita", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Allen", "TX", "USA", "United States", "Texas", "Americans", "Western", "Central", "Allen Event Center", "Allen", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Tulsa", "OK", "USA", "United States", "Oklahoma", "Oilers", "Western", "Central", "BOK Center", "Tulsa", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Independence", "MO", "USA", "United States", "Missouri", "Mavericks", "Western", "Central", "Silverstein Eye Centers Arena", "Missouri", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "ECHL", "West", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Anchorage", "AK", "USA", "United States", "Alaska", "Aces", "Western", "West", "Sullivan Arena", "Alaska", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Boise", "ID", "USA", "United States", "Idaho", "Steelheads", "Western", "West", "CenturyLink Arena", "Idaho", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "West Valley City", "UT", "USA", "United States", "Utah", "Grizzlies", "Western", "West", "Maverik Center", "Utah", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Loveland", "CO", "USA", "United States", "Colorado", "Eagles", "Western", "West", "Budweiser Events Center", "Colorado", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "ECHL", "20151007", "Rapid City", "SD", "USA", "United States", "South Dakota", "Rush", "Western", "West", "Rushmore Plaza Civic Center", "Rapid City", "", True, True);
libhockeydata.MakeHockeyTeamTable(sqldatacon, "AHL");
libhockeydata.MakeHockeyConferenceTable(sqldatacon, "AHL");
libhockeydata.MakeHockeyGameTable(sqldatacon, "AHL");
libhockeydata.MakeHockeyDivisionTable(sqldatacon, "AHL");
libhockeydata.MakeHockeyLeague(sqldatacon, "AHL", "American Hockey League", "USA", "United States", "20151009", "Division=4", "ORDER BY PCT DESC, GamesPlayed ASC, TWins DESC, Losses ASC, GoalsDifference DESC");
libhockeydata.MakeHockeyConference(sqldatacon, "AHL", "Eastern", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "AHL", "Atlantic", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Bridgeport", "CT", "USA", "United States", "Connecticut", "Sound Tigers", "Eastern", "Atlantic", "Webster Bank Arena", "Bridgeport", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Hartford", "CT", "USA", "United States", "Connecticut", "Wolf Pack", "Eastern", "Atlantic", "XL Center", "Hartford", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Hershey", "PA", "USA", "United States", "Pennsylvania", "Bears", "Eastern", "Atlantic", "Giant Center", "Hershey", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Allentown", "PA", "USA", "United States", "Pennsylvania", "Phantoms", "Eastern", "Atlantic", "PPL Center", "Lehigh Valley", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Portland", "ME", "USA", "United States", "Maine", "Pirates", "Eastern", "Atlantic", "Cross Insurance Arena", "Portland", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Providence", "RI", "USA", "United States", "Rhode Island", "Bruins", "Eastern", "Atlantic", "Dunkin' Donuts Center", "Providence", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Springfield", "MA", "USA", "United States", "Massachusetts", "Falcons", "Eastern", "Atlantic", "MassMutual Center", "Springfield", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Wilkes-Barre", "PA", "USA", "United States", "Pennsylvania", "Penguins", "Eastern", "Atlantic", "Mohegan Sun Arena", "Wilkes-Barre/Scranton", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "AHL", "North", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Albany", "NY", "USA", "United States", "New York", "Devils", "Eastern", "North", "Times Union Center", "Albany", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Binghamton", "NY", "USA", "United States", "New York", "Senators", "Eastern", "North", "Floyd L. Maines Veterans Memorial Arena", "Binghamton", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Rochester", "NY", "USA", "United States", "New York", "Americans", "Eastern", "North", "Blue Cross Arena", "Rochester", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "St. John's", "NL", "CAN", "Canada", "Newfoundland and Labrador", "IceCaps", "Eastern", "North", "Mile One Centre", "St. John's", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Syracuse", "NY", "USA", "United States", "New York", "Crunch", "Eastern", "North", "Oncenter War Memorial Arena", "Syracuse", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Toronto", "ON", "CAN", "Canada", "Ontario", "Marlies", "Eastern", "North", "Ricoh Coliseum", "Toronto", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Utica", "NY", "USA", "United States", "New York", "Comets", "Eastern", "North", "Utica Memorial Auditorium", "Utica", "", True, True);
libhockeydata.MakeHockeyConference(sqldatacon, "AHL", "Western", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "AHL", "Central", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Charlotte", "NC", "USA", "United States", "North Carolina", "Checkers", "Western", "Central", "Bojangles Coliseum", "Charlotte", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Rosemont", "IL", "USA", "United States", "Illinois", "Wolves", "Western", "Central", "Allstate Arena", "Chicago", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Grand Rapids", "MI", "USA", "United States", "Michigan", "Griffins", "Western", "Central", "Van Andel Arena", "Grand Rapids", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Des Moines", "IA", "USA", "United States", "Iowa", "Wild", "Western", "Central", "Wells Fargo Arena", "Iowa", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Cleveland", "OH", "USA", "United States", "Ohio", "Monsters", "Western", "Central", "Quicken Loans Arena", "Lake Erie", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Winnipeg", "MB", "CAN", "Canada", "Manitoba", "Moose", "Western", "Central", "MTS Centre", "Manitoba", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Milwaukee", "WI", "USA", "United States", "Wisconsin", "Admirals", "Western", "Central", "BMO Harris Bradley Center", "Milwaukee", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Rockford", "IL", "USA", "United States", "Illinois", "IceHogs", "Western", "Central", "BMO Harris Bank Center", "Rockford", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "AHL", "Pacific", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Bakersfield", "CA", "USA", "United States", "California", "Condors", "Western", "Pacific", "Rabobank Arena", "Bakersfield", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Ontario", "CA", "USA", "United States", "California", "Reign", "Western", "Pacific", "Citizens Business Bank Arena", "Ontario", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "San Antonio", "TX", "USA", "United States", "Texas", "Rampage", "Western", "Pacific", "AT&T Center", "San Antonio", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "San Diego", "CA", "USA", "United States", "California", "Gulls", "Western", "Pacific", "Valley View Casino Center", "San Diego", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "San Jose", "CA", "USA", "United States", "California", "Barracuda", "Western", "Pacific", "SAP Center", "San Jose", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Stockton", "CA", "USA", "United States", "California", "Heat", "Western", "Pacific", "Stockton Arena", "Stockton", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "AHL", "20151009", "Cedar Park", "TX", "USA", "United States", "Texas", "Stars", "Western", "Pacific", "Cedar Park Center", "Texas", "", True, True);
libhockeydata.MakeHockeyArena(sqldatacon, "AHL", "West Sacramento", "CA", "USA", "United States", "California", "Raley Field");
libhockeydata.MakeHockeyTeamTable(sqldatacon, "NHL");
libhockeydata.MakeHockeyConferenceTable(sqldatacon, "NHL");
libhockeydata.MakeHockeyGameTable(sqldatacon, "NHL");
libhockeydata.MakeHockeyDivisionTable(sqldatacon, "NHL");
libhockeydata.MakeHockeyLeague(sqldatacon, "NHL", "National Hockey League", "USA", "United States", "20151007", "Division=3,Conference=2", "ORDER BY Points DESC, GamesPlayed ASC, TWins DESC, Losses ASC, GoalsDifference DESC");
libhockeydata.MakeHockeyConference(sqldatacon, "NHL", "Eastern", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "NHL", "Atlantic", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Boston", "MA", "USA", "United States", "Massachusetts", "Bruins", "Eastern", "Atlantic", "TD Garden", "Boston", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Buffalo", "NY", "USA", "United States", "New York", "Sabres", "Eastern", "Atlantic", "First Niagara Center", "Buffalo", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Detroit", "MI", "USA", "United States", "Michigan", "Red Wings", "Eastern", "Atlantic", "Joe Louis Arena", "Detroit", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Sunrise", "FL", "USA", "United States", "Florida", "Panthers", "Eastern", "Atlantic", "BB&T Center", "Florida", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Montreal", "QC", "CAN", "Canada", "Quebec", "Canadiens", "Eastern", "Atlantic", "Bell Centre", "Montreal", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Ottawa", "ON", "CAN", "Canada", "Ontario", "Senators", "Eastern", "Atlantic", "Canadian Tire Centre", "Ottawa", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Tampa Bay", "FL", "USA", "United States", "Florida", "Lightning", "Eastern", "Atlantic", "Amalie Arena", "Tampa Bay", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Toronto", "ON", "CAN", "Canada", "Ontario", "Maple Leafs", "Eastern", "Atlantic", "Air Canada Centre", "Toronto", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "NHL", "Metropolitan", "Eastern", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Carolina", "NC", "USA", "United States", "North Carolina", "Hurricanes", "Eastern", "Metropolitan", "PNC Arena", "Carolina", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Columbus", "OH", "USA", "United States", "Ohio", "Blue Jackets", "Eastern", "Metropolitan", "Nationwide Arena", "Columbus", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "New Jersey", "NJ", "USA", "United States", "New Jersey", "Devils", "Eastern", "Metropolitan", "Prudential Center", "New Jersey", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "New York City", "NY", "USA", "United States", "New York", "Islanders", "Eastern", "Metropolitan", "Barclays Center", "New York", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "New York City", "NY", "USA", "United States", "New York", "Rangers", "Eastern", "Metropolitan", "Madison Square Garden", "New York", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Philadelphia", "PA", "USA", "United States", "Pennsylvania", "Flyers", "Eastern", "Metropolitan", "Wells Fargo Center", "Philadelphia", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Pittsburgh", "PA", "USA", "United States", "Pennsylvania", "Penguins", "Eastern", "Metropolitan", "Consol Energy Center", "Pittsburgh", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Washington", "DC", "USA", "United States", "District of Columbia", "Capitals", "Eastern", "Metropolitan", "Verizon Center", "Washington", "", True, True);
libhockeydata.MakeHockeyConference(sqldatacon, "NHL", "Western", "", "Conference", True);
libhockeydata.MakeHockeyDivision(sqldatacon, "NHL", "Central", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Chicago", "IL", "USA", "United States", "Illinois", "Blackhawks", "Western", "Central", "United Center", "Chicago", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Denver", "CO", "USA", "United States", "Colorado", "Avalanche", "Western", "Central", "Pepsi Center", "Colorado", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Dallas", "TX", "USA", "United States", "Texas", "Stars", "Western", "Central", "American Airlines Center", "Dallas", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "St. Paul", "MN", "USA", "United States", "Minnesota", "Wild", "Western", "Central", "Xcel Energy Center", "Minnesota", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Nashville", "TN", "USA", "United States", "Tennessee", "Predators", "Western", "Central", "Bridgestone Arena", "Nashville", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "St. Louis", "MO", "USA", "United States", "Missouri", "Blues", "Western", "Central", "Scottrade Center", "St. Louis", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Winnipeg", "MB", "CAN", "Canada", "Manitoba", "Jets", "Western", "Central", "MTS Centre", "Winnipeg", "", True, True);
libhockeydata.MakeHockeyDivision(sqldatacon, "NHL", "Pacific", "Western", "", "Division", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Anaheim", "CA", "USA", "United States", "California", "Ducks", "Western", "Pacific", "Honda Center", "Anaheim", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Glendale", "AZ", "USA", "United States", "Arizona", "Coyotes", "Western", "Pacific", "Gila River Arena", "Arizona", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Calgary", "AB", "CAN", "Canada", "Alberta", "Flames", "Western", "Pacific", "Scotiabank Saddledome", "Calgary", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Edmonton", "AB", "CAN", "Canada", "Alberta", "Oilers", "Western", "Pacific", "Rexall Place", "Edmonton", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Los Angeles", "CA", "USA", "United States", "California", "Kings", "Western", "Pacific", "Staples Center", "Los Angeles", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "San Jose", "CA", "USA", "United States", "California", "Sharks", "Western", "Pacific", "SAP Center", "San Jose", "", True, True);
libhockeydata.MakeHockeyTeam(sqldatacon, "NHL", "20151007", "Vancouver", "BC", "CAN", "Canada", "British Columbia", "Canucks", "Western", "Pacific", "Rogers Arena", "Vancouver", "", True, True);
libhockeydata.MakeHockeyArena(sqldatacon, "NHL", "Foxborough", "MA", "USA", "United States", "Massachusetts", "Gillette Stadium");
libhockeydata.MakeHockeyArena(sqldatacon, "NHL", "Minneapolis", "MN", "USA", "United States", "Minnesota", "TCF Bank Stadium");
libhockeydata.MakeHockeyArena(sqldatacon, "NHL", "Denver", "CO", "USA", "United States", "Colorado", "Coors Field");

libhockeydata.CloseHockeyDatabase(sqldatacon);