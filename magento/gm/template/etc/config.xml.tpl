<?xml version="1.0"?>
<config>
    <modules>
        <{{Package}}_{{Module}}>
            <version>0.1.0</version>
        </{{Package}}_{{Module}}>
    </modules>
    <admin>
        <routers>
            <adminhtml>
                <args>
                    <modules>
                        <{{Package}}_{{Module}}_Adminhtml after="Mage_Adminhtml">{{Package}}_{{Module}}_Adminhtml</{{Package}}_{{Module}}_Adminhtml>
                    </modules>
                </args>
            </adminhtml>
        </routers>
    </admin>
    <frontend>
        <routers>
            <{{module}}>
                <use>standard</use>
                <args>
                    <module>{{Package}}_{{Module}}</module>
                    <frontName>{{module}}</frontName>
                </args>
            </{{module}}>
        </routers>
        <layout>
            <updates>
                <{{package}}_{{module}}>
                    <file>{{package}}/{{module}}.xml</file>
                </{{package}}_{{module}}>
            </updates>
        </layout>
    </frontend>
    <global>
        <blocks>
            <{{package}}_{{module}}>
                <class>{{Package}}_{{Module}}_Block</class>
            </{{package}}_{{module}}>
        </blocks>
        <models>
            <{{package}}_{{module}}>
                <class>{{Package}}_{{Module}}_Model</class>
                <resourceModel>{{package}}_{{module}}_resource</resourceModel>
            </{{package}}_{{module}}>
            <{{package}}_{{module}}_resource>
                <class>{{Package}}_{{Module}}_Model_Resource</class>
                <entities>
                    <{{model}}>
                        <table>{{package}}_{{module}}_{{model}}</table>
                    </{{model}}>
                </entities>
            </{{package}}_{{module}}_resource>
        </models>
        <helpers>
            <{{package}}_{{module}}>
                <class>{{Package}}_{{Module}}_Helper</class>
            </{{package}}_{{module}}>
        </helpers>
    </global>
</config>