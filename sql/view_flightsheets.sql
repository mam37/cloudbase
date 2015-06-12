create view view_flightsheets as
select svc_date, flight_takeoff, flight_landing, duration, plane_serial, 
pilot, concat("$" , format(svc_cost/100, 2)) as svc_cost
from view_flights left outer join view_pilots
on view_flights.flight_id=view_pilots.flight_id; 

