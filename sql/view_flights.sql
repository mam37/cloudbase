create view view_flights as
select flight_id, svc_date, plane_serial, plane_type, 
flight_takeoff, flight_landing,
(select timediff(flight_landing, flight_takeoff)) as duration, 
(select if(plane_type="tow", svc_cost=null, svc_cost) 
) as svc_cost
from service, flight, plane  
where service.svc_id = flight.svc_id and 
      flight.plane_id = plane.plane_id and
      flight.flight_landing != "00:00:00";
