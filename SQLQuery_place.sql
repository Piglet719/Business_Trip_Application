create table place(
TripPlace varchar(30) not null,
ItineraryDescription varchar(50) not null,
Category varchar(10),
AccommodationNeeds varchar(30),
AccommodationDescription varchar(50),
primary key (TripPlace,ItineraryDescription))