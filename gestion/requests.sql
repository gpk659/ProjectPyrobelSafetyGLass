/*
* Request emplacement new loss
*/
Select idEmplacement, nomUsine, u.description,  nomFichierPlan, nomZone, nomPosition

from  db_project_pyrobel.emplacement as e,
	    db_project_pyrobel.usine as u,
      db_project_pyrobel.zone as z,
      db_project_pyrobel.rack as r

where e.usine_idUsine = u.idUsine
      and e.zone_idZone = z.idZone
	    and e.rack_idRack = r.idRack;


/*
* Request operateur new loss
 */
SELECT *
FROM db_project_pyrobel.listeoperateur as l,
  db_project_pyrobel.usine as u,
  db_project_pyrobel.zone as z

where l.usine_idUsine = u.idUsine
      and l.zone_idZone = z.idZone;



/*
* Request plateau new loss
 */

SELECT *
FROM db_project_pyrobel.plateau as p,
     db_project_pyrobel.emplacement as e,
     db_project_pyrobel.type as t
WHERE p.emplacement_idEmplacement = e.idEmplacement
      and p.type_idType = t.idType;