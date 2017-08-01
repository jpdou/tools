<?xml version="1.0"?>
<config>
    <menu>
         <{{package}}>
            <children>
                <manage_{{model}} translate="title" module="cms">
                    <title>Manage {{Module}} {{model}}</title>
                    <action>adminhtml/{{module}}</action>
                    <sort_order>1000</sort_order>
                </manage_{{model}}>
            </children>
         </{{package}}>
    </menu>
    <acl>
        <resources>
            <admin>
                <children>
                    <{{package}}>
                        <children>
                            <manage_{{model}} translate="title">
                                <title>Manage {{Module}} {{model}}</title>
                                <sort_order>1000</sort_order>
                            </manage_{{model}}>
                        </children>
                    </{{package}}>
                </children>
            </admin>
        </resources>
    </acl>
</config>
