import pandas as pd
import numpy as np
df = pd.read_csv('/Users/francescorodriguez/Documents/Bases de Datos/trabajadores.csv')
df2 = pd.read_csv('/Users/francescorodriguez/Downloads/Impares/aerodromos.csv')
df3 = pd.read_csv('/Users/francescorodriguez/Downloads/Impares/vuelos.csv')
df4 = pd.read_csv('/Users/francescorodriguez/Downloads/Impares/rutas.csv')
df5 = pd.read_csv('/Users/francescorodriguez/Downloads/Impares/reservasV2.csv')
lista_csv = []
rutas = df4
lista_csv.append(rutas)
piloto = df[df.rol == 'Piloto']
piloto = piloto[['trabajador_id', 'pasaporte', 'nombre', 'fecha_nacimiento', 'rol', 'licencia_actual_id']].copy()
lista_csv.append(piloto)
copiloto = df[df.rol == 'Copiloto']
copiloto = copiloto[['trabajador_id', 'pasaporte', 'nombre', 'fecha_nacimiento', 'rol', 'licencia_actual_id']].copy()
lista_csv.append(copiloto)
empleado = df
empleado = empleado[['trabajador_id', 'pasaporte', 'nombre', 'fecha_nacimiento', 'rol', 'licencia_actual_id']].copy()
empleado = empleado.drop('licencia_actual_id', 1)
lista_csv.append(empleado)
aerodromo = df2.drop('nombre_pais', 1)
lista_csv.append(aerodromo)
pais = df2[['nombre_ciudad', 'nombre_pais']].copy()
lista_csv.append(pais)
aeronave = df3[['codigo_aeronave','nombre_aeronave', 'modelo', 'peso']].copy()
lista_csv.append(aeronave)
vuelo = df3[['vuelo_id','codigo_vuelo','aerodromo_salida_id','aerodromo_llegada_id','codigo_aeronave','codigo_compania','fecha_salida','fecha_llegada','velocidad','altitud','estado','ruta_id']].copy()
lista_csv.append(vuelo)
vuelo_aeronave = df3[['vuelo_id','codigo_aeronave']]
lista_csv.append(vuelo_aeronave)
costo = df3[['ruta_id','peso', 'valor']]
lista_csv.append(costo)
compania = df3[['codigo_compania', 'nombre_compania']].copy()
lista_csv.append(compania)
empleado_en_vuelo = df[['trabajador_id','vuelo_id']].copy()
lista_csv.append(empleado_en_vuelo)
pasajero = df5[['pasaporte_pasajero','nombre_pasajero', 'nacionalidad_pasajero', 'fecha_nacimiento_pasajero']].copy()
lista_csv.append(pasajero)
comprador = df5[['pasaporte_comprador','nombre_comprador', 'nacionalidad_comprador', 'fecha_nacimiento_comprador']].copy()
lista_csv.append(comprador)
ticket = df5[['reserva_id','codigo_reserva', 'numero_ticket', 'vuelo_id', 'pasaporte_comprador', 'pasaporte_pasajero', 'numero_asiento','clase', 'comida_y_maleta']].copy()
lista_csv.append(ticket)

for elemento in range(len(lista_csv)):
    
    lista_csv[elemento].dropna()
    lista_csv[elemento] = lista_csv[elemento].apply(lambda x: x.astype(str).str.lower())



##Cambiar fechas a datetime
lista_csv[1]['fecha_nacimiento'] =  pd.to_datetime(lista_csv[1]['fecha_nacimiento'], format='%d-%m-%Y')
lista_csv[2]['fecha_nacimiento'] =  pd.to_datetime(lista_csv[2]['fecha_nacimiento'], format='%d-%m-%Y')
lista_csv[3]['fecha_nacimiento'] =  pd.to_datetime(lista_csv[3]['fecha_nacimiento'], format='%d-%m-%Y')
lista_csv[7]['fecha_salida'] = pd.to_datetime(lista_csv[7]['fecha_salida'], format='%Y-%m-%d %H:%M:%S')
lista_csv[7]['fecha_llegada'] = pd.to_datetime(lista_csv[7]['fecha_llegada'], format='%Y-%m-%d %H:%M:%S')
lista_csv[12]['fecha_nacimiento_pasajero'] = pd.to_datetime(lista_csv[12]['fecha_nacimiento_pasajero'], format='%d-%m-%Y')
lista_csv[13]['fecha_nacimiento_comprador'] = pd.to_datetime(lista_csv[13]['fecha_nacimiento_comprador'], format='%d-%m-%Y')

#Transformar vuelo_id a int
lista_csv[11]['vuelo_id']= pd.to_numeric(lista_csv[11]['vuelo_id'], errors = 'coerce').convert_dtypes()
for elemento in range(len(lista_csv)):
    lista_csv[elemento] = lista_csv[elemento].dropna()
    lista_csv[elemento] = lista_csv[elemento].reset_index(drop=True)
    lista_csv[elemento] = lista_csv[elemento].drop_duplicates()
    
   

print(lista_csv[12]['fecha_nacimiento_pasajero'][565:567])
#Pasamos dataframes a csv

lista_csv[0].to_csv('rutas.csv', index=False, encoding = 'utf-8')
lista_csv[1].to_csv('piloto.csv', index=False, encoding = 'utf-8')
lista_csv[2].to_csv('copiloto.csv', index=False, encoding = 'utf-8')
lista_csv[3].to_csv('empleado.csv', index=False, encoding = 'utf-8')
lista_csv[4].to_csv('aerodromo.csv', index=False, encoding = 'utf-8')
lista_csv[5].to_csv('pais.csv', index=False, encoding = 'utf-8')
lista_csv[6].to_csv('aeronave.csv', index=False, encoding = 'utf-8')
lista_csv[7].to_csv('vuelo.csv', index=False, encoding = 'utf-8')
lista_csv[8].to_csv('vuelo_aeronave.csv', index=False, encoding = 'utf-8')
lista_csv[9].to_csv('costo.csv', index=False, encoding = 'utf-8')
lista_csv[10].to_csv('compania.csv', index=False, encoding = 'utf-8')
lista_csv[11].to_csv('empleado_en_vuelo.csv', index=False, encoding = 'utf-8')
lista_csv[12].to_csv('pasajero.csv', index=False, encoding = 'utf-8')
lista_csv[13].to_csv('comprador.csv', index=False, encoding = 'utf-8')
lista_csv[14].to_csv('ticket.csv', index=False, encoding = 'utf-8')


'''
lista_csv(index)
0 = rutas check int, check fechas
1 = piloto check int, check fechas
2 = copiloto check int, check fechas
3 = empleado check int, check fechas
4 = aerodromo check int
5 = pais check
6 = aeronave check
7 = vuelo CHECK todo
8= vuelo_aeronave check
9 = costo check
10 = compania check
11 = empleado_en_vuelo check
12 = pasajero check
13 = comprador check
14 = ticket check



'''
