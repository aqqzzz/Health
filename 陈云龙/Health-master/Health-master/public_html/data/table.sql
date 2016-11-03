
-- 用户表
CREATE TABLE user (
    id varchar(64) PRIMARY KEY,
    name varchar(64),
    pass varchar(64),
    identity integer DEFAULT 1,     -- 0:管理员;1:普通用户;2:医生;3:教练
    goal double DEFAULT 0,          -- 本周运动目标/公里
    avatar varchar(64) DEFAULT "images/default.jpg",
    sex integer DEFAULT 0,          -- 0:男;1:女
    motto text,                     -- 座右铭
    docid varchar(64) DEFAULT -1,       -- 医生id,-1代表无
    coaid varchar(64) DEFAULT -1,       -- 教练id,-1代表无
    run_time integer DEFAULT 0,     -- 运动总时间/天
    run_distance integer DEFAULT 0, -- 运动总距离/公里
    UNIQUE (name)
);

INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('cyl19941016', 'cylong', 'cyl941016', 1, 10, 'images/avatar.jpg', 0, 'run run run', "doc_id", "coa_id", 43, 67);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('doc_id', 'doc_name', 'doc_pass', 2, 0, 'images/doctor.jpg', 1, 'I am a doctor', -1, -1, 31, 89);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('coa_id', 'coa_name', 'coa_pass', 3, 0, 'images/coach.jpg', 0, 'I am a coach', -1, -1, 3, 6);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('doc_id1', 'doc_name1', 'doc_pass1', 2, 0, 'images/doctor.jpg', 1, 'I am a doctor1', -1, -1, 56, 23);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('coa_id1', 'coa_name1', 'coa_pass1', 3, 0, 'images/coach.jpg', 0, 'I am a coach1', -1, -1, 90, 93);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid, run_time, run_distance) VALUES ('user_id', 'user_name', 'user_pass', 1, 40, 'images/user.jpg', 0, 'I am a user', "doc_id", "coa_id", 62, 46);
INSERT INTO user (id, name, pass, identity, goal, avatar, sex, motto, docid, coaid) VALUES ('admin', 'admin', 'admin', 0, 0, 'images/admin.jpg', 0, 'I am a admin', -1, -1);
SELECT * FROM user;

-- 用户健康表
CREATE TABLE user_health (
    id integer PRIMARY KEY,
    uid varchar(64),
    create_date date DEFAULT (datetime('now', 'localtime')),
    height double DEFAULT 0,
    weight double DEFAULT 0,
    hr integer DEFAULT 0,         -- 心率
    bph integer DEFAULT 0,        -- 收缩压
    bpl integer DEFAULT 0,        -- 舒张压
    run_distance double DEFAULT 0 -- 运动距离
);

INSERT INTO user_health(uid, create_date, height, weight, hr, bph, bpl, run_time, run_distance) VALUES (1, '2015-12-12', 179, 56, 60, 100, 70, 30.1, 20.3);

SELECT * FROM user_health;

-- 活动表
CREATE TABLE activity (
    id integer PRIMARY KEY,
    title varchar(64),
    a_time datetime DEFAULT (datetime('now', 'localtime')),
    place varchar(128),
    info text,                      -- 活动描述
    num integer DEFAULT 0,          -- 参与人数
    recommend_num  integer DEFAULT 0     -- 推荐的人数
);

SELECT * FROM activity;

-- 用户参加活动表
CREATE TABLE user_activity (
    uid varchar(64),
    aid varchar(64)
);

SELECT * FROM user_activity;

-- 医生的反馈表
CREATE TABLE d_feed_back (
    id integer PRIMARY KEY,
    uid varchar(64),
    docid varchar(64),
    fbdate datetime DEFAULT (datetime('now', 'localtime')),
    info text
);

-- 教练的反馈表
CREATE TABLE c_feed_back (
    id integer PRIMARY KEY,
    uid varchar(64),
    coaid varchar(64),
    fbdate datetime DEFAULT (datetime('now', 'localtime')),
    info text
);

-- 动态
CREATE TABLE moments (
    id integer PRIMARY KEY,
    uid varchar(64),
    mdate datetime DEFAULT (datetime('now', 'localtime')),
    content text
);
