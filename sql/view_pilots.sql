create view view_pilots as
select flight_id, concat_ws(", ", person_lname, person_fname) as pilot 
from person, flight_role
where person.person_id = flight_role.role_id;
