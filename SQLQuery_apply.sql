create table apply(
ApplyID int identity(1,1) not null,
Applicant varchar(10),
Agent varchar(10),
Cause varchar(50),
TripPlace varchar(30),
Days int,
StartDate datetime,
EndDate datetime,
Traffic varchar(20),
BookingDescription varchar(50),
Currency varchar(10),
Price int,
ItineraryDescription varchar(50),
Remarks varchar(50),
InsertTime datetime,
primary key (ApplyID),
foreign key (Applicant) references employee(Name),
foreign key (Agent) references employee(Name),
foreign key (TripPlace,ItineraryDescription) references place(TripPlace,ItineraryDescription) ON DELETE CASCADE ON UPDATE CASCADE)