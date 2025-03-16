-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2018 at 17:25
-- Server version: 10.1.32-MariaDB

set SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
set AUTOCOMMIT = 0;
start transaction;

--
-- Database: invent
--

delimiter $$
--
-- Procedures
--
create procedure inventory_reset() begin
	-- Month opening
	insert into inventory (_item, _quantity, _date, _user)
	select s._id, s._quantity, current_date(), 1 from inventory_status s;

	-- Month ending
	insert into inventory (_item, _quantity, _date, _user)
	select s._item, -s._quantity, last_day(date_add(current_date(), interval -1 month)), 1 from inventory s where s._date = current_date();
end$$

delimiter ;

-- --------------------------------------------------------

--
-- Table structure for table ingredients
--

create table ingredients (
	_meal int not NULL,
	_ingredient int not NULL,
	_quantity decimal(16, 2) not NULL
) engine=InnoDB default charset=latin1;

--
-- Dumping data for table ingredients
--

insert into ingredients (_meal, _ingredient, _quantity) values
(1, 1, 0.2),
(1, 2, 0.2),
(2, 2, 0.6);

-- --------------------------------------------------------

--
-- Table structure for table inventory
--

create table inventory (
	_item int default NULL,
	_price int default 0,
	_quantity decimal(16, 2) not NULL,
	_date datetime not NULL,
	_user int not NULL
) engine=InnoDB default CHARSET=latin1;

--
-- Dumping data for table inventory
--

insert into inventory (_item, _price, _quantity, _date, _user) values
(1, 0, 5, '2018-12-04 11:38:15', 1),
(1, 0, 5, '2018-12-04 11:38:15', 1),
(2, 0, 4, '2018-12-04 11:38:15', 1),
(2, 0, 2, '2018-12-04 11:38:15', 1),
(2, 0, 2, '2018-12-04 11:38:15', 1),
(3, 0, 10, '2018-12-04 11:38:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table menu
--

create table menu (
	_id int not NULL,
	_name varchar(64) not NULL,
	_price int default 0
) engine=InnoDB default charset=latin1;

--
-- Dumping data for table menu
--

insert into menu (_id, _name, _price) values
(1, 'Meal 1', 0),
(2, 'Meal 2', 0),
(3, 'Meal 3', 0),
(4, 'Meal 4', 0),
(5, 'Meal 5', 0);

-- --------------------------------------------------------

--
-- Table structure for table stock
--

create table stock (
	_id int not NULL,
	_name varchar(64) not NULL,
	_unit varchar(8) default 'x',
	_price int default 0
) engine=InnoDB default charset=latin1;

--
-- Dumping data for table stock
--

insert into stock (_id, _name, _unit, _price) values
(1, 'Item 1', 'kg', NULL),
(2, 'Item 2', 'kg', NULL),
(3, 'Item 3', 'kg', NULL),
(4, 'Item 4', 'kg', NULL);

-- --------------------------------------------------------

--
-- Structure for view inventory_status
--

create view inventory_status as select
	s._id as _id,
	s._name as _name,
	ifnull(sum(i._quantity), 0) as _quantity,
	s._unit as _unit
from stock s
left join inventory i on i._item = s._id and i._date >= date_format(current_date(), '%Y-%m-01')
group by s._id, s._name, s._unit;

--
-- Indexes for dumped tables
--

--
-- Indexes for table ingredients
--
alter table ingredients
	add primary key (_meal, _ingredient),
	add key fk_ingredient_idx (_ingredient);

--
-- Indexes for table inventory
--
alter table inventory
	add key fk_item_idx (_item);

--
-- Indexes for table menu
--
alter table menu
	add primary key (_id),
	add unique key _name_unique (_name);

--
-- Indexes for table stock
--
alter table stock
	add primary key (_id),
	add unique key _name_UNIQUE (_name);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table menu
--
alter table menu
	modify _id int not NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table stock
--
alter table stock
	modify _id int not NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table ingredients
--
alter table ingredients
	add constraint fk_ingredient foreign key (_ingredient) references stock (_id) on delete no action on update no action,
	add constraint fk_meal foreign key (_meal) references menu (_id) on delete no action on update no action;

--
-- Constraints for table inventory
--
alter table inventory
	add constraint fk_item foreign key (_item) references stock (_id) on delete no action on update no action;

delimiter $$
--
-- Events
--
create event ev_inventory_reset on schedule every 1 month starts '2018-12-01 00:00:00' do call invent.inventory_reset()$$

delimiter ;
commit;
