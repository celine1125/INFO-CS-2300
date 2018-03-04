# Part 1: Plan, Create, and Populate a Database

## Database Schema

[insert DB schema here]

employees(work_id: (INTEGER, PK, U, NOT, AI), name: (STRING, NOT), type: (STRING, NOT));

## SQL Queries

[Paste your correct SQL queries below.]

[In markdown, format SQL queries like this:]
```sql
SELECT * FROM movies;
```

1. get all fields for all employees

```sql
SELECT * FROM employee;
```

2. return two fields (e.g. first name, last name) for employees that are staff

```sql
SELECT first_name, last_name
FROM employee
WHERE position='staff';
```

3. return a natural key for employees who are managers

```sql
SELECT employee_id
FROM employee
WHERE position='manager';
```

4. return all fields for the employees who's first name starts with *a*

```sql
SELECT *
FROM employee
WHERE first_name LIKE 'a%';
```

5. return all fields for the employees who's last name ends with *n*

```sql
SELECT *
FROM employee
WHERE last_name LIKE '%n';
```

6. return all fields for the employees who have an *l* anywhere in their last name.

```sql
SELECT *
FROM employee
WHERE last_name LIKE '%l%';
```

7. return a natural key for employees who are staff and who's first name starts with *c*.

```sql
SELECT employee_id
FROM employee
WHERE first_name LIKE 'c%'
  AND position='staff';
```
